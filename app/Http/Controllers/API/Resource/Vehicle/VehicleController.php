<?php
/**
 * Created by PhpStorm.
 * User: angelformica
 * Date: 2018-12-12
 * Time: 19:09
 */

namespace App\Http\Controllers\API\Resource\Vehicle;


use App\Http\Controllers\Controller;
use App\Http\Resources\VehicleCollection;
use App\Http\Resources\VehicleResource;
use App\Models\Company\Company;
use App\Models\Resources\Vehicles\Vehicle;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class VehicleController extends Controller {
	/**
	 * List the vehicles for the given company
	 *
	 * @param Request $request
	 *
	 * @return VehicleCollection
	 */
	public function index(Request $request){
		$request->validate([
			'company_id' => 'required|exists:companies,id'
		]);
		$company = Company::findOrFail($request->query('company_id'));
		return new VehicleCollection($company->vehicles);
	}

	/**
	 * Show the requeste vehicle
	 *
	 * @param $id
	 *
	 * @return VehicleResource
	 */
	public function show($id){
		return new VehicleResource(Vehicle::findOrFail($id));
	}
	/**
	 * Create a vehicle for the given company
	 * @param Request $request
	 *
	 * @return \Illuminate\Http\JsonResponse
	 */
	public function store(Request $request){
		$request->validate([
			'company_id' => 'required|exists:companies,id',
			'name' => 'required|unique:resources,name|max:255',
			'capacity' => 'required|numeric'
		]);
		$data = $request->all();
		$company = Company::findOrFail($request->get('company_id'));
		$vehicle = new Vehicle($data);
		$company->vehicles()->save($vehicle);
		return response()->json([
			'data' => $vehicle,
			'message' => 'The vehicle was created successfully'
		],200);
	}

	/**
	 * Update the vehicle with the new data
	 *
	 * @param Request $request
	 * @param $id
	 *
	 * @return \Illuminate\Http\JsonResponse
	 */
	public function update(Request $request,$id){
		$vehicle = Vehicle::findOrFail($id);
		$request->validate([
			'name' => [
				'required',
				Rule::unique('resources','name')->ignore($vehicle->id,'id'),
				'max:255',
			],
			'capacity' => 'required|numeric'
		]);
		$data = $request->all();
		$vehicle->update($data);
		return response()->json([
			'data' => $vehicle,
			'message' => 'The vehicle was updated successfully'
		],200);
	}

	/**
	 * Delete a vehicle
	 *
	 * @param $id
	 *
	 * @return \Illuminate\Http\JsonResponse
	 */
	public function destroy($id){
		$vehicle = Vehicle::findOrFail($id);
		$vehicle->delete();
		return response()->json(null,204);
	}
}