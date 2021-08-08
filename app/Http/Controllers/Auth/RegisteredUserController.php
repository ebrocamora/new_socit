<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Providers\RouteServiceProvider;
use Illuminate\Auth\Events\Registered;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules;

class RegisteredUserController extends Controller
{
    /**
     * Display the registration view.
     *
     * @return \Illuminate\View\View
     */
    public function create()
    {
        return view('auth.register');
    }

    /**
     * Handle an incoming registration request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\RedirectResponse
     *
     * @throws \Illuminate\Validation\ValidationException
     */
    public function store(Request $request)
    {
        $request->validate([
            'first_name' => 'required|string|max:255',
            'middle_name' => 'nullable|string|max:255',
            'last_name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users|ends_with:apc.edu.ph,student.apc.edu.ph',
            'username' => 'required|string|alpha_num|max:255|unique:users',
            'password' => ['required', 'confirmed', Rules\Password::defaults()],
            'referrer' => 'nullable|exists:users,username',
        ],
        [
            'email.ends_with' => 'Email must end in the following :values',
            'referrer.exists' => 'The referrer does not exists.',
        ]);

        $user = new User();
        $user->first_name = $request->first_name;
        $user->middle_name = $request->middle_name;
        $user->last_name = $request->last_name;
        $user->email = $request->email;
        $user->username = $request->username;
        $user->password = Hash::make($request->password);
        if($request->referrer) {
            $referrer = User::where('username', $request->referrer)->first();
            $user->referrer_id = $referrer->id;
        }
        $user->save();

        $user->assignRole('guest');
        $user->givePermissionTo('rewards:redeem');
        $user->givePermissionTo('rewards:read');
        $user->givePermissionTo('account:create');
        $user->givePermissionTo('account:read');
        $user->givePermissionTo('account:update');
        $user->givePermissionTo('account:delete');

        event(new Registered($user));

        Auth::login($user);

        return redirect(RouteServiceProvider::HOME);
    }
}
