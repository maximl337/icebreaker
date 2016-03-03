<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use Auth;
use App\Http\Requests;

class PagesController extends Controller
{

	public function __construct()
	{
		$this->middleware('auth', ['only' => ['demo', 'connect']]);
	}

    public function demo()
    {
    	return view('demo.index');
    }

    public function authenticate()
    {
    	return view('pages.authenticate');
    }

    public function connect()
    {
    	$user = Auth::user();

    	// check accessTokens
        $user->linkedin = $user->accessTokens()->where('provider', 'linkedin')->latest()->first();

        $user->facebook = $user->accessTokens()->where('provider', 'facebook')->latest()->first();

        $user->twitter = $user->accessTokens()->where('provider', 'twitter')->latest()->first();

        $user->google = $user->accessTokens()->where('provider', 'google')->latest()->first();

        return view('pages.connect', compact('user'));
    }
}
