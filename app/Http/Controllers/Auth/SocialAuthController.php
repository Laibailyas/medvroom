<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\PatientProfile;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Laravel\Socialite\Facades\Socialite;

class SocialAuthController extends Controller
{
    /**
     * Redirect the user to the provider authentication page.
     */
    public function redirect(string $provider)
    {
        return Socialite::driver($provider)->redirect();
    }

    /**
     * Obtain the user information from the provider.
     */
    public function callback(string $provider)
    {
        $socialUser = Socialite::driver($provider)->user();

        // Check if a user with this provider/provider_id exists
        $user = User::where('provider', $provider)
            ->where('provider_id', $socialUser->getId())
            ->first();

        if ($user) {
            $this->loginAndRedirect($user);

            return redirect(config('app.frontend_url', '/dashboard'));
        }

        // Otherwise, check if a user with this email already exists
        $user = User::where('email', $socialUser->getEmail())->first();

        if ($user) {
            // Update the existing user with social provider details
            $user->update([
                'provider' => $provider,
                'provider_id' => $socialUser->getId(),
                'provider_token' => $socialUser->token,
            ]);
        } else {
            // Create a new user with patient role
            $nameParts = explode(' ', $socialUser->getName() ?? '');
            $firstName = $nameParts[0] ?? '';
            $lastName = count($nameParts) > 1 ? implode(' ', array_slice($nameParts, 1)) : '';

            $user = User::create([
                'first_name' => $firstName,
                'last_name' => $lastName,
                'name' => $socialUser->getName() ?? $socialUser->getNickname() ?? 'User',
                'email' => $socialUser->getEmail(),
                'provider' => $provider,
                'provider_id' => $socialUser->getId(),
                'provider_token' => $socialUser->token,
                'role' => User::ROLE_PATIENT,
                'email_verified_at' => now(), // Assume social login emails are verified
            ]);

            // Create patient profile for the new user
            PatientProfile::create([
                'user_id' => $user->id,
            ]);
        }

        $this->loginAndRedirect($user);

        return redirect()->intended(route('dashboard', absolute: false));
    }

    private function loginAndRedirect(User $user)
    {
        Auth::login($user, true); // true for "remember me"
    }
}
