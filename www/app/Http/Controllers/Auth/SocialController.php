<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Support\Facades\Auth;
use Laravel\Socialite\Facades\Socialite;
use App\User;
use App\SocialAccount;

class SocialController extends Controller
{
    public function __construct()
    {
        $this->middleware('guest', ['except' => 'logout']);
    }


    /**
     * TwitterOAuth
     */
    public function getTwitterAuth()
    {
        return Socialite::with('twitter')->redirect();
    }

    public function getTwitterAuthCallback()
    {
        $twitterUser = Socialite::with('twitter')->user();
        $user = $this->findOrCreateUser($twitterUser, 'twitter');
        Auth::login($user, true);
        return redirect('/home');
    }


    /**
     * FacebookAuth
     */
    public function getFacebookAuth()
    {
        return Socialite::with('facebook')->redirect();
    }

    public function getFacebookAuthCallback()
    {
        $facebookUser = Socialite::with('facebook')->user();
        $user = $this->findOrCreateUser($facebookUser, 'facebook');
        Auth::login($user, true);
        return redirect('/home');
    }


    /**
     * GoogleAuth
     */
    public function getGoogleAuth()
    {
        return Socialite::with('google')->redirect();
    }

    public function getGoogleAuthCallback()
    {
        $googleUser = Socialite::with('google')->user();
        $user = $this->findOrCreateUser($googleUser, 'google');
        Auth::login($user, true);
        return redirect('/home');
    }


    /**
     * InstagramAuth
     */
    public function getInstagramAuth()
    {
        return Socialite::with('instagram')->redirect();
    }

    public function getInstagramAuthCallback()
    {
        $instagramUser = Socialite::with('instagram')->user();
        $user = $this->findOrCreateUser($instagramUser, 'instagram');
        Auth::login($user, true);
        return redirect('/home');
    }


    /**
     * Providerからユーザの作成 / 取得
     *
     * @return User
     */
    public function findOrCreateUser($providerUser, $provider)
    {
        $account = SocialAccount::where('provider', $provider)
            ->where('provider_user_id', $providerUser->id)
            ->first();

        if (empty($account)) {
            $account = SocialAccount::create([
                'provider_user_id' => $providerUser->id,
                'provider' => $provider,
                'provider_access_token' => $providerUser->token,
            ]);
        }

        if (empty($account->user)) {
            $user = User::create([
                'name' => $providerUser->name,
                'email' => $providerUser->email,
            ]);
            $account->user()->associate($user);
        }

        $account->provider_access_token = $providerUser->token;
        $account->save();

        return $account->user;
    }
}
