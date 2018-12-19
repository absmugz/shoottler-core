<?php
/**
 * Created by PhpStorm.
 * User: angelformica
 * Date: 2018-12-19
 * Time: 13:45
 */

namespace App\Traits;


use App\Models\Booking\Booking;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\MorphMany;

trait HasBookings {

	/**
	 * The customer may have many bookings.
	 *
	 * @return \Illuminate\Database\Eloquent\Relations\MorphMany
	 */
	public function bookings(): MorphMany
	{
		return $this->morphMany(Booking::class,'customer');
	}

	/**
	 * Boot the HasBookings trait for the model.
	 *
	 * @return void
	 */
	public static function bootHasBookings()
	{
		static::deleted(function (self $model) {
			$model->bookings()->delete();
		});
	}

	/**
	 * Book the given model at the given dates with the given price.
	 *
	 * @param \Illuminate\Database\Eloquent\Model $bookable
	 * @param string                              $startsAt
	 * @param string                              $endsAt
	 *
	 * @return Model
	 */
	public function newBooking(Model $bookable, string $startsAt, string $endsAt): Model
	{
		return $this->bookings()->create([
			'bookable_id' => $bookable->getKey(),
			'bookable_type' => $bookable->getMorphClass(),
			'customer_id' => $this->getKey(),
			'customer_type' => $this->getMorphClass(),
			'starts_at' => (new Carbon($startsAt))->toDateTimeString(),
			'ends_at' => (new Carbon($endsAt))->toDateTimeString(),
		]);
	}
}