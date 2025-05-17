<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;
use Laravel\Socialite\Facades\Socialite;

class DiscordController extends Controller
{
    public function redirectToDiscord()
    {
        return Socialite::driver('discord')->redirect();
    }

    public function handleDiscordCallback()
    {
        try {
            $discordUser = Socialite::driver('discord')->user();

            // Find or create user
            $user = User::updateOrCreate(
                ['discord_id' => $discordUser->getId()],
                [
                    'name' => $discordUser->getName(),
                    'email' => $discordUser->getEmail(),
                    'avatar' => $discordUser->getAvatar(),
                    'password' => bcrypt(Str::random(16)), // Random password
                ]
            );

            Auth::login($user, true);

            return redirect()->intended('/');
        } catch (\Exception $e) {
            return redirect('/')->with('error', 'Failed to login with Discord.');
        }
    }
}
