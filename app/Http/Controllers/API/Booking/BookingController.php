<?php
/**
 * Created by PhpStorm.
 * User: angelformica
 * Date: 2018-12-19
 * Time: 14:09
 */

namespace App\Http\Controllers\API\Booking;


use App\Http\Controllers\Controller;
use App\Http\Resources\BookingCollection;
use App\Http\Resources\BookingResource;
use App\Models\Booking\Booking;
use App\Models\Company\Company;
use App\Models\Customer\Base\Customer;
use App\Models\Items\Item;
use Carbon\Carbon;
use Illuminate\Http\Request;

class BookingController extends Controller {

	/**
	 * List the bookings of the given company
	 * @param Request $request
	 *
	 * @return BookingCollection
	 */
	public function index(Request $request){
		$company = Company::findOrFail($request->get('company_id'));
		Return new BookingCollection($company->bookings);
	}

	/**
	 * Show the requested Booking
	 *
	 * @param $id
	 *
	 * @return BookingResource
	 */
	public function show($id){
		$booking = Booking::findOrFail($id);
		Return new BookingResource($booking);
	}

	/**
	 * Create a new booking for the given customer
	 *
	 * @param Request $request
	 *
	 * @return \Illuminate\Http\JsonResponse
	 */
	public function store(Request $request){
		$request->validate([
			'customer_id' => 'required|exists:customers,id',
			'bookable_id' => 'required|exists:items,id',
			'starts_at' => 'required',
			'ends_at' => 'required'
		]);
		$customer = Customer::findOrFail($request->input('customer_id'));
		$bookable = Item::findOrFail($request->input('bookable_id'));
		$booking = $customer->newBooking($bookable,$request->input('starts_at'),$request->input('ends_at'));
		return response()->json([
			'data' => $booking,
			'message' => 'Booking created successfully'
		],200);
	}

	/**
	 * Update the booking with the new data
	 *
	 * @param Request $request
	 * @param $id
	 *
	 * @return \Illuminate\Http\JsonResponse
	 */
	public function update(Request $request,$id){
		$booking = Booking::findOrFail($id);
		$request->validate([
			'customer_id' => 'required|exists:customers,id',
			'bookable_id' => 'required|exists:items,id',
			'starts_at' => 'required',
			'ends_at' => 'required'
		]);
		$data = $request->all();
		$customer = Customer::findOrFail($request->input('customer_id'));
		$bookable = Item::findOrFail($request->input('bookable_id'));
		$data = array_replace($data, [
			'bookable_id' => $bookable->getKey(),
			'bookable_type' => $bookable->getMorphClass(),
			'customer_id' => $customer->getKey(),
			'customer_type' => $customer->getMorphClass(),
			'starts_at' => (new Carbon($request->input('starts_at')))->toDateTimeString(),
			'ends_at' => (new Carbon($request->input('ends_at')))->toDateTimeString(),
		]);
		$booking->update($data);
		return response()->json([
			'data' => $booking,
			'message' => 'The booking has been updated successfully'
		],200);
	}

	/**
	 * Delete the booking
	 * @param $id
	 *
	 * @return \Illuminate\Http\JsonResponse
	 */
	public function destroy($id){
		$booking = Booking::findOrFail($id);
		$booking->delete();
		return response()->json(null,204);
	}
}