<?php
/**
 * Created by PhpStorm.
 * User: angelformica
 * Date: 2018-12-19
 * Time: 13:33
 */

namespace App\Traits;


use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\MorphMany;

trait Bookable {
	/**
	 * The resource may have many bookings.
	 *
	 * @return \Illuminate\Database\Eloquent\Relations\MorphMany
	 */
	public function bookings(): MorphMany
	{
		return $this->morphMany(static::$singleTableType, 'bookable');
	}

	/**
	 * Boot the Bookable trait for the model.
	 *
	 * @return void
	 */
	public static function bootBookable()
	{
		static::deleted(function (self $model) {
			$model->bookings()->delete();
		});
	}
	/**
	 * Book the model for the given customer at the given dates with the given price.
	 *
	 * @param \Illuminate\Database\Eloquent\Model $customer
	 * @param string                              $startsAt
	 * @param string                              $endsAt
	 *
	 * @return Model
	 */
	public function newBooking(Model $customer, string $startsAt, string $endsAt): Model
	{
		return $this->bookings()->create([
			'bookable_id' => static::getKey(),
			'bookable_type' => static::getMorphClass(),
			'customer_id' => $customer->getKey(),
			'customer_type' => $customer->getMorphClass(),
			'starts_at' => (new Carbon($startsAt))->toDateTimeString(),
			'ends_at' => (new Carbon($endsAt))->toDateTimeString(),
		]);
	}
}