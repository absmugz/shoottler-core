<?php
/**
 * Created by PhpStorm.
 * User: angelformica
 * Date: 2018-12-13
 * Time: 17:17
 */

namespace App\Http\Controllers\API\Service;

use App\Http\Controllers\Controller;
use App\Http\Resources\ServiceCollection;
use App\Http\Resources\ServiceResource;
use App\Models\Company\Company;
use App\Models\Items\ItemType;
use App\Models\Items\Service;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class ServiceController extends Controller {

	/**
	 * List the services of the given company
	 * @param Request $request
	 *
	 * @return ServiceCollection
	 */
	public function index(Request $request){
		$company = Company::findOrFail($request->get('company_id'));
		return new ServiceCollection($company->services);
	}

	/**
	 * Show the requested service
	 * @param $id
	 *
	 * @return ServiceResource
	 */
	public function show($id){
		return new ServiceResource(Service::findOrFail($id));
	}

	/**
	 * Create a service for the given company
	 * @param Request $request
	 *
	 * @return \Illuminate\Http\JsonResponse
	 */
	public function store(Request $request){
		$request->validate([
			'company_id' => 'required',
			'type' => 'required|exists:item_types,id',
			'name' => 'required|max:255|unique:items,name'
		]);
		$data = $request->all();
		$company = Company::findOrFail($request->get('company_id'));
		$itemType = ItemType::findOrFail($request->input('type'));
		$model = app( $itemType->class );
		$item = new $model($data);
		$request->validate($item::$rules);
		$company->items()->save($item);
		return response()->json([
			'data' => $item,
			'message' => 'The service was created successfully'
		],201);
	}

	/**
	 * Update the service with the new data
	 * @param Request $request
	 * @param $id
	 *
	 * @return \Illuminate\Http\JsonResponse
	 */
	public function update(Request $request,$id){
		$service = Service::findOrFail($id);
		$request->validate([
			'name' => [
				'required',
				Rule::unique('items','name')->ignore($service->id,'id'),
				'max:255',
			],
		]);
		$data = $request->all();
		$service->update($data);
		return response()->json([
			'data' => $service,
			'message' => 'The service has been updated successfully'
		],200);
	}

	/**
	 * Delete the service
	 * @param $id
	 *
	 * @return \Illuminate\Http\JsonResponse
	 */
	public function destroy($id){
		$service = Service::findOrFail($id);
		$service->delete();
		return response()->json(null,204);
	}
}