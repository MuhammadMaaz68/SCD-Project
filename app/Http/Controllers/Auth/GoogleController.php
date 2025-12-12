<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Laravel\Socialite\Facades\Socialite;
use Illuminate\Support\Str;

class GoogleController extends Controller
{
    // 1) Redirect user to Google
    public function redirectToGoogle()
    {
        return Socialite::driver('google')->redirect();
    }

    // 2) Handle callback from Google
    public function handleGoogleCallback()
    {
        try {
            $googleUser = Socialite::driver('google')->user();

            // Find existing user OR create new one
            $user = User::where('email', $googleUser->getEmail())->first();

            if (! $user) {
                $user = User::create([
                    'name'              => $googleUser->getName(),
                    'email'             => $googleUser->getEmail(),
                    'password'          => bcrypt(Str::random(16)), // random password
                    'email_verified_at' => now(), // optional
                    // 'role'           => 'user', // if you have roles
                ]);
            }

            // Log the user in
            Auth::login($user);

            // Redirect based on role if you want
            // if ($user->role === 'admin') {
            //     return redirect()->route('admin.dashboard');
            // }

            return redirect()->route('dashboard'); // or home page

        } catch (\Exception $e) {
            // You can dd($e->getMessage()) while testing
            return redirect()->route('login')->with('error', 'Something went wrong with Google login.');
        }
    }
}