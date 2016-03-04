<?php

namespace App\Http\Controllers\Auth;

use Log;
use Auth;
use App\User;
use Socialite;
use Validator;
use App\AccessToken;
use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\ThrottlesLogins;
use Illuminate\Foundation\Auth\AuthenticatesAndRegistersUsers;

class AuthController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Registration & Login Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles the registration of new users, as well as the
    | authentication of existing users. By default, this controller uses
    | a simple trait to add these behaviors. Why don't you explore it?
    |
    */

    use AuthenticatesAndRegistersUsers, ThrottlesLogins;

    /**
     * Where to redirect users after login / registration.
     *
     * @var string
     */
    protected $redirectTo = '/connect';

    /**
     * Create a new authentication controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        //$this->middleware('guest', ['except' => ['logout']]);

        $this->middleware('auth', ['only' => ['redirectToTwitter']]);
    }

    /**
     * Get a validator for an incoming registration request.
     *
     * @param  array  $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
    protected function validator(array $data)
    {
        return Validator::make($data, [
            'name' => 'required|max:255',
            'email' => 'required|email|max:255|unique:users',
            'password' => 'required|confirmed|min:6',
        ]);
    }

    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array  $data
     * @return User
     */
    protected function create(array $data)
    {
        return User::create([
            'name' => $data['name'],
            'email' => $data['email'],
            'password' => bcrypt($data['password']),
        ]);
    }

    /**
     * [redirectToLinkedin description]
     * @return [type] [description]
     */
    public function redirectToLinkedin()
    {
        return Socialite::driver('linkedin')->redirect();
    }

    /**
     * [handleLinkedinCallback description]
     * @return [type] [description]
     */
    public function handleLinkedinCallback()
    {
        $socialUser = Socialite::driver('linkedin')->user();

        Log::info(['social user' => serialize($socialUser)]);

        $user = $this->makeUser($socialUser, 'linkedin');
        
        return redirect('connect');
    }

    public function redirectToFacebook()
    {
        return Socialite::driver('facebook')->redirect();
    }

    public function handleFacebookCallback()
    {
        $socialUser = Socialite::driver('facebook')->user();

        Log::info(['social user' => serialize($socialUser)]);

        $user = $this->makeUser($socialUser, 'facebook');
        
        return redirect('connect');
    }

    /**
     * [redirectToTwitter description]
     * @param  string $value [description]
     * @return [type]        [description]
     */
    public function redirectToTwitter($value='')
    {
        return Socialite::driver('twitter')->redirect();
    }

    /**
     * [handleTwitterCallback description]
     * @return [type] [description]
     */
    public function handleTwitterCallback()
    {
        $socialUser = Socialite::driver('twitter')->user();

        Log::info(['social user' => serialize($socialUser)]);

        $access_token = Auth::user()->accessTokens()->where('provider', 'twitter')->latest()->first();

        if(is_null($access_token)) {

            $access_token = new AccessToken([
                        'provider' => 'twitter',
                        'provider_id' => $socialUser->getId(),
                        'username'    => !empty($socialUser->getNickname()) ? $socialUser->getNickname() : null,
                        'token'       => $socialUser->token,
                        'token_secret' => !empty($socialUser->tokenSecret) ? $socialUser->tokenSecret : null
                ]);

            Auth::user()->accessTokens()->save($access_token);
        }
        
        return redirect('connect');
    }

    /**
     * [makeUser description]
     * @param  [type] $userObject [description]
     * @param  [type] $provider   [description]
     * @return [type]             [description]
     */
    protected function makeUser($userObject, $provider)
    {
        $user = User::where('email', $userObject->email)->first();

        if(is_null($user)) {

            $user = User::create([
                    'name' => $userObject->getName(),
                    'provider' => $provider,
                    'email'    => $userObject->getEmail(),
                    'avatar'   => $userObject->getAvatar()
                ]);

        }

        // check if access token exists
        $access_token = AccessToken::where('provider', $provider)->latest()->first();

        if(is_null($access_token)) {

           $access_token = new AccessToken([
                                'provider' => $provider,
                                'provider_id' => $userObject->getId(),
                                'username'    => !empty($userObject->getNickname()) ? $userObject->getNickname() : null,
                                'token'       => $userObject->token,
                                'token_secret' => !empty($userObject->tokenSecret) ? $userObject->tokenSecret : null
                            ]);

            $user->accessTokens()->save($access_token);

        }

        Auth::login($user);

    }
}
