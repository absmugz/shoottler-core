<?php
/**
 * Created by PhpStorm.
 * User: angelformica
 * Date: 2018-12-19
 * Time: 13:18
 */

namespace App\Models\Booking;


use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\MorphTo;

class Booking extends Model {

	protected $fillable = [
		'order_id',
		'customer_type',
		'customer_id',
		'bookable_id',
		'bookable_type',
		'starts_at',
		'ends_at'
	];

	/**
	 * Get the owning resource model.
	 *
	 * @return \Illuminate\Database\Eloquent\Relations\MorphTo
	 */
	public function bookable(): MorphTo
	{
		return $this->morphTo('bookable', 'bookable_type', 'bookable_id');
	}
	/**
	 * Get the booking customer.
	 *
	 * @return \Illuminate\Database\Eloquent\Relations\MorphTo
	 */
	public function customer(): MorphTo
	{
		return $this->morphTo('customer', 'customer_type', 'customer_id');
	}
}