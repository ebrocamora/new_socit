<?php

namespace App\Http\Livewire;

use App\Models\Reward;
use App\Models\User;
use App\Models\UserReward;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Cache;
use Livewire\Component;

class PointTracker extends Component
{
    public $points;

    protected $listeners = ['codeSubmitted', 'rewardGiven' => 'getCurrentUserPoints'];

    public function codeSubmitted($code)
    {
        $reward = Reward::where('code', $code)->first();

        if($reward) {
            $userReward = UserReward::where([
                ['user_id', Auth::id()],
                ['reward_id', $reward->id]
            ])->first();

            if(!$userReward) {
                $userReward = new UserReward();
                $userReward->user_id = Auth::id();
                $userReward->reward_id = $reward->id;
                $userReward->save();

                activity()
                    ->causedBy(auth()->id())
                    ->on($userReward)
                    ->event('redeemed')
                    ->withProperties(['attributes' => ['name' => $reward->name]])
                    ->log('redeemed');

                $this->emit('code:success', $code);

                $this->dispatchBrowserEvent('rewardGiven', ['reward' => $reward]);
                return $this->emit('rewardGiven', $reward);
            }
            $this->dispatchBrowserEvent('code:exists', ['reward' => $reward]);
            return $this->emit('code:exists', $reward->name);
        }

        $this->dispatchBrowserEvent('code:error', ['code' => $code]);
        return $this->emit('code:error', $code);

    }

    public function getCurrentUserPoints()
    {
        $points = 0;

        /* Get points if has referrer */
        if(auth()->user()->referrer_id) {
            $points += 50;
        }

        /* Get points for referrals */
        $users = Cache::remember('users', 60, function() {
            return User::with('referrer')->get();
        });

        if($users) {
            foreach($users as $user) {
                if($user->referrer) {
                    if(auth()->user()->id === $user->referrer->id) {
                        $points += 50;
                    }
                }
            }
        }

        /* Get points from rewards */
        $rewards = UserReward::where('user_id', Auth::id())->get();

        if($rewards) {
            foreach($rewards as $reward) {
                $rewardInfo = Reward::find($reward->reward_id);
                $points += $rewardInfo->point_count;
            }
        }

        $this->points = $points;
    }

    public function mount() {
        $this->getCurrentUserPoints();
    }

    public function render()
    {
        return view('livewire.point-tracker');
    }
}
