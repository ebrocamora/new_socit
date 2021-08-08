<?php

namespace App\Http\Livewire;

use App\Models\User;
use App\Models\UserReward;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Pagination\Paginator;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Cache;
use Livewire\Component;
use Illuminate\Http\Request;
use Livewire\WithPagination;

class Leaderboard extends Component
{
    use WithPagination;

    public function render()
    {
        $usersCollection = collect();

        $users = Cache::remember('users', 60, function() {
            return User::withCount('reward', 'referral', 'referrer')->get();
        });

//        $users = User::with(['reward', 'referral', 'referrer'])->get();

        foreach($users as $index => $user) {
            $points = 0;
            $position = 0;
//            if(!($user->hasRole('admin') || $user->hasRole('super-admin'))) {
                if(User::find($user->referrer)) $points += 50;
                foreach($user->reward as $reward) {
                    $points += $reward->reward->point_count;
                }
                $points += count($user->referral) * 50;
                $usersCollection->push([
                    'position' => $index,
                    'first_name' => $user->first_name,
                    'last_name' => $user->last_name,
                    'points' => $points,
                ]);
//            }
        }

        return view('livewire.leaderboard', [
            'users' => $this->paginate($usersCollection, 15),
        ]);
    }

    /**
     * The attributes that are mass assignable.
     *
     *
     * @param $items
     * @param int $perPage
     * @param null $page
     * @param array $options
     * @return LengthAwarePaginator
     */
    public function paginate($items, int $perPage = 5, $page = null, $options = []): LengthAwarePaginator
    {
        $page = $page ?: (Paginator::resolveCurrentPage() ?: 1);
        $items = $items instanceof Collection ? $items : Collection::make($items);
        return new LengthAwarePaginator($items->forPage($page, $perPage), $items->count(), $perPage, $page, $options);
    }
}
