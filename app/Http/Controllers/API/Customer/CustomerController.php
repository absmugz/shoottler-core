<?php
/**
 * Created by PhpStorm.
 * User: angelformica
 * Date: 2018-12-17
 * Time: 20:17
 */

namespace App\Http\Controllers\API\Customer;

use App\Http\Controllers\Controller;
use App\Http\Resources\CustomerCollection;
use App\Http\Resources\CustomerResource;
use App\Models\Company\Company;
use App\Models\Customer\Base\Customer;
use App\Models\Customer\Type\CustomerType;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class CustomerController extends Controller {

	/**
	 * List the customer of the given company
	 * @param Request $request
	 *
	 * @return CustomerCollection
	 */
	public function index(Request $request){
		$company = Company::findOrFail($request->get('company_id'));
		return new CustomerCollection($company->customers);
	}

	/**
	 * Show the requested customer
	 * @param $id
	 *
	 * @return CustomerResource
	 */
	public function show($id){
		$customer = Customer::findOrFail($id);
		return new CustomerResource($customer);
	}

	/**
	 * Create a customer for the given company
	 * @param Request $request
	 *
	 * @return \Illuminate\Http\JsonResponse
	 */
	public function store(Request $request){
		$request->validate([
			'email' => [
				'email',
				'required',
				Rule::unique('customers','email')
			]
		]);
		$data = $request->all();
		$company = Company::findOrFail($request->get('company_id'));
		$customerType = CustomerType::findOrFail($request->input('type'));
		$model = app( $customerType->class );
		$customer = new $model($data);
		$request->validate($customer::$rules);
		$company->customers()->save($customer);
		return response()->json([
			'data' => $customer,
			'message' => 'The customer was created successfully'
		],201);
	}

	/**
	 * Update the customer with the new data
	 * @param Request $request
	 * @param $id
	 *
	 * @return \Illuminate\Http\JsonResponse
	 */
	public function update(Request $request,$id){
		$customer = Customer::findOrFail($id);
		$request->validate([
			'email' => [
				'email',
				'required',
				Rule::unique('customers','name')->ignore($customer->id,'id')
			]
		]);
		$data = $request->all();
		$customer->update($data);
		return response()->json([
			'data' => $customer,
			'message' => 'The customer has been updated successfully'
		],200);
	}

	/**
	 * Delete the customer
	 * @param $id
	 *
	 * @return \Illuminate\Http\JsonResponse
	 */
	public function destroy($id){
		$customer = Customer::findOrFail($id);
		$customer->delete();
		return response()->json(null,204);
	}
}