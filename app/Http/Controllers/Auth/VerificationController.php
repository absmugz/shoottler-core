<?php
/**
 * Created by PhpStorm.
 * User: angelformica
 * Date: 11/20/18
 * Time: 7:38 PM
 */

namespace App\Http\Controllers\Auth;


use App\Http\Controllers\Controller;
use App\Models\User\User;
use Illuminate\Auth\Events\Verified;
use Illuminate\Foundation\Auth\VerifiesEmails;
use Illuminate\Http\Request;

class VerificationController extends Controller {

	/*
	|--------------------------------------------------------------------------
	| Email Verification Controller
	|--------------------------------------------------------------------------
	|
	| This controller is responsible for handling email verification for any
	| settings that recently registered with the application. Emails may also
	| be resent if the settings did not receive the original email message.
	|
	*/

	use VerifiesEmails;

	/**
	 * Where to redirect users after verification.
	 *
	 * @var string
	 */
	protected $redirectTo = '/app/dashboard';

	/**
	 * Create a new controller instance.
	 *
	 * @return mixed
	 */
	public function __construct()
	{
		$this->middleware('signed')->only('verify');
		$this->middleware('throttle:6,1')->only('verify', 'resend');
	}
	/**
	 * Override Laravel Verification Method
	 *
	 * @param  \Illuminate\Http\Request  $request
	 * @return \Illuminate\Http\Response
	 */
	public function verify(Request $request)
	{
		$user = User::findOrFail($request->route('id'));
		if ($request->route('id') == $user->getKey() &&
		    $user->markEmailAsVerified()) {
			event(new Verified($user));
		}

		return redirect($this->redirectPath())->with('verified', true);
	}
}