<?php

namespace App\Models\Company;

use App\Models\Booking\Booking;
use App\Models\Customer\Base\Customer;
use App\Models\Resources\Vehicles\Vehicle;
use App\Models\User\User;
use Illuminate\Database\Eloquent\Model;
use Modules\GeoSpatial\Entities\Area;
use Modules\GeoSpatial\Entities\Zone;
use Modules\Item\Entities\Item;

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
	/**
	 * This company's items
	 * @return \Illuminate\Database\Eloquent\Relations\HasMany
	 */
    public function items(){
    	return $this->hasMany(Item::class);
    }

	/**
	 * This company's customers
	 * @return \Illuminate\Database\Eloquent\Relations\HasMany
	 */
    public function customers() {
    	return $this->hasMany(Customer::class);
    }

	/**
	 * This company's bookings
	 *
	 * @return \Illuminate\Database\Eloquent\Relations\HasManyThrough
	 */
    public function bookings() {
    	return $this->hasManyThrough(Booking::class,Customer::class);
    }
}
