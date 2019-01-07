<?php
/**
 * Created by PhpStorm.
 * User: angelformica
 * Date: 9/26/18
 * Time: 8:52 PM
 */

namespace App\Traits;

use App\Models\Resources\Amenity;

trait Amenitytable {
	/**
	 * This resource's Amenities
	 * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
	 */
	public function amenities(){
		return $this->morphToMany(Amenity::class,'amenitytable')->withPivot('qty','is_Exclusion');
	}

	/**
	 * Delete relation
	 */
	protected static function bootAmenitytable()
	{
		self::deleting(function ($model) {
			$model->amenities()->detach();
		});
	}
	public function attachAmenities(Array $amenities = null){
		$syncArray = [];
		if ($amenities){
			foreach ($amenities as $amenity){
				$syncArray[$amenity['id']] = ['qty' => $amenity['qty']];
			}
			return $this->amenities()->sync($syncArray);
		} else {
			return $this->amenities()->detach();
		}
	}
}