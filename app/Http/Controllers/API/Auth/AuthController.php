<?php

namespace App\Http\Controllers\API\Auth;

use App\Http\Controllers\Controller;
use App\Models\User\User;
use Illuminate\Auth\Events\Registered;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
	/**
	 * Logs the settings in
	 *
	 * @param Request $request
	 *
	 * @return \Illuminate\Http\JsonResponse
	 */
    public function login(Request $request){
    	return $this->getAccessToken(
		    config('services.passport.client_id'),
		    config('services.passport.client_secret'),
		    'password',
		    config('services.passport.login_endpoint'),
		    $request->username,
		    $request ->password);
    }
	/**
	 * Registers a new settings
	 * @param Request $request
	 *
	 * @return mixed
	 */
	public function register(Request $request)
	{
		$request->validate([
			'name' => 'required|string|max:255',
			'email' => 'required|string|email|max:255|unique:users',
			'password' => 'required|string|min:6',
		]);
		event(new Registered($user = User::create([
			'name' => $request->name,
			'email' => $request->email,
			'password' => Hash::make($request->password),
		])));

		return $user;
	}
	/**
	 * Logs the settings out
	 *
	 * @return \Illuminate\Http\JsonResponse
	 */
    public function logout(){
	    auth()->user()->tokens->each(function ($token, $key) {
		    $token->delete();
	    });
	    return response()->json(__('Logged out successfully'), 200);
    }
	/**
	 *
	 * Check the email verification status of the settings
	 * @param Request $request
	 *
	 * @return JsonResponse
	 */
	public function emailVerificationStatus(Request $request){
		return response()->json(
			['email_verified' => $request->user()->hasVerifiedEmail() || null]
			,200
		);
	}
}
