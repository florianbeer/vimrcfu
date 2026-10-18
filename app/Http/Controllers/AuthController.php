<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Laravel\Socialite\Facades\Socialite;

class AuthController extends Controller
{
    /**
     * Send requests on other hosts to the OAuth callback host, then
     * redirect to GitHub, or log the User in when
     * GitHub redirects back with a code.
     */
    public function login(Request $request)
    {
        $callbackHost = parse_url(config('services.github.redirect'), PHP_URL_HOST);

        if ($callbackHost && $callbackHost !== $request->getHost()) {
            return redirect()->away(config('services.github.redirect'));
        }

        if (! $request->has('code')) {
            return Socialite::driver('github')->redirect();
        }

        $githubUser = Socialite::driver('github')->user();

        $user = User::firstOrNew(['github_id' => (string) $githubUser->getId()]);
        $user->fill([
            'github_url' => $githubUser->user['html_url'] ?? 'https://github.com/'.$githubUser->getNickname(),
            'avatar_url' => $githubUser->getAvatar(),
            'email' => $githubUser->getEmail(),
            'name' => $githubUser->getName() ?: $githubUser->getNickname(),
        ]);
        $user->save();

        Auth::login($user, remember: true);

        $request->session()->regenerate();

        return redirect()->intended();
    }

    /**
     * Log out User.
     */
    public function logout(Request $request)
    {
        Auth::logout();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect()->route('home');
    }
}
