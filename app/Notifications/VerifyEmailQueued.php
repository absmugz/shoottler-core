<?php
/**
 * Created by PhpStorm.
 * User: angelformica
 * Date: 11/20/18
 * Time: 8:42 PM
 */

namespace App\Notifications;


use Carbon\Carbon;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;
use Illuminate\Support\Facades\Lang;
use Illuminate\Support\Facades\URL;

class VerifyEmailQueued extends Notification implements ShouldQueue {

	use Queueable;
	protected $guard;

	public function __construct($guard) {
		$this->guard = $guard;
	}

	/**
	 * The callback that should be used to build the mail message.
	 *
	 * @var \Closure|null
	 */
	public static $toMailCallback;

	/**
	 * Get the notification's channels.
	 *
	 * @param  mixed  $notifiable
	 * @return array|string
	 */
	public function via($notifiable)
	{
		return ['mail','database'];
	}

	/**
	 * Build the mail representation of the notification.
	 *
	 * @param  mixed  $notifiable
	 * @return \Illuminate\Notifications\Messages\MailMessage
	 */
	public function toMail($notifiable)
	{
		if (static::$toMailCallback) {
			return call_user_func(static::$toMailCallback, $notifiable);
		}

		return (new MailMessage())
			->subject(Lang::getFromJson('Verify Email Address'))
			->line(Lang::getFromJson('Please click the button below to verify your email address.'))
			->action(
				Lang::getFromJson('Verify Email Address'),
				$this->verificationUrl($notifiable)
			)
			->line(Lang::getFromJson('If you did not create an account, no further action is required.'));
	}

	/**
	 * Get the verification URL for the given notifiable.
	 *
	 * @param  mixed  $notifiable
	 *
	 * @return string
	 */
	protected function verificationUrl($notifiable)
	{
		return URL::temporarySignedRoute(
			$this->guard .'.verification.verify', Carbon::now()->addMinutes(60), ['id' => $notifiable->getKey()]
		);
	}

	/**
	 * Set a callback that should be used when building the notification mail message.
	 *
	 * @param  \Closure  $callback
	 * @return void
	 */
	public static function toMailUsing($callback)
	{
		static::$toMailCallback = $callback;
	}

	public function toArray($notifiable){
		return [
			'message' => 'Please verify your email'
		];
	}
}