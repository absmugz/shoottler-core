<?php

namespace App\Models\Company;

use App\Models\Area\Area;
use App\Models\Area\Zone;
use App\Models\Resources\Vehicles\Vehicle;
use App\Models\User\User;
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

	/**
	 * This company's areas
	 * @return \Illuminate\Database\Eloquent\Relations\HasMany
	 */
    public function areas(){
    	return $this->hasMany(Area::class);
    }

	/**
	 * This company's zones
	 * @return \Illuminate\Database\Eloquent\Relations\HasManyThrough
	 */
    public function zones(){
    	return $this->hasManyThrough(Zone::class,Area::class);
    }
	/**
	 * This company's vehicles
	 * @return \Illuminate\Database\Eloquent\Relations\HasMany
	 */
    public function vehicles(){
    	return $this->hasMany(Vehicle::class);
    }
}
