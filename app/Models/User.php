<?php

namespace App\Models;

use App\Company;
use App\Notifications\VerifyEmailQueued;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Laravel\Passport\HasApiTokens;

class User extends Authenticatable implements MustVerifyEmail
{
    use HasApiTokens, Notifiable;
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password',
    ];
    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];
	/**
	 * Override the laravel notification.
	 * To implement queued notifications
	 */
	public function sendEmailVerificationNotification()
	{
		$this->notify((new VerifyEmailQueued('web'))->delay(now()->addSeconds(5)));
	}
	/**
	 * This settings's companies
	 * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
	 */
	public function companies(){
		return $this->belongsToMany(Company::class);
	}

	/**
	 * Sets the default company for the user
	 * @param Company $company
	 *
	 * @return mixed
	 */
	public function setDefaultCompany(Company $company){
		return $this->setAttribute('default_company_id',$company->id)->save();
	}
}
