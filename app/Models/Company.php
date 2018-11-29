<?php

namespace App;

use App\Models\User;
use Illuminate\Database\Eloquent\Model;

class Company extends Model
{
	/**
	 * The attributes that are mass assignable
	 * @var array
	 */
    protected $fillable = [
    	'name',
	    'brand',
	    'website',
	    'facebook',
	    'google_plus',
	    'tripadvisor'
    ];

	/**
	 * This company's users
	 * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
	 */
    public function users(){
    	return $this->belongsToMany(User::class);
    }
}
