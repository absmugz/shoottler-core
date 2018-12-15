<?php
/**
 * Created by PhpStorm.
 * User: angelformica
 * Date: 2018-11-29
 * Time: 15:10
 */

namespace App\Http\Controllers\API\Area;

use App\Http\Resources\AreaCollection;
use App\Http\Resources\AreaResource;
use App\Models\Area\Airport;
use App\Models\Area\Area;
use App\Models\Area\Port;
use App\Models\Area\TrainStation;
use App\Models\Company\Company;
use Illuminate\Http\Request;

class AreaController {

	/**
	 * List the areas of the given company
	 * @param Request $request
	 *
	 * @return AreaCollection
	 */
	public function index(Request $request){
		$company = Company::findOrFail($request->query('company_id'));
		return new AreaCollection($company->areas);
	}

	/**
	 * Show the requested area
	 * @param $id
	 *
	 * @return AreaResource
	 */
	public function show($id){
		return new AreaResource(Area::findOrFail($id));
	}

	/**
	 * Create a service area for the given company
	 *
	 * @param Request $request
	 *
	 * @return \Illuminate\Http\JsonResponse
	 */
	public function store(Request $request){
		$area = '';
		$request->validate([
			'name' => 'required|max:255',
			'country' => 'required|max:255',
			'city' => 'required|max:255',
		]);
		$company = Company::findOrFail($request->get('company_id'));
		$data = $request->all();
		switch ($request->get('type')) {
			case 'airport':
				$area = new Airport($data);
				break;
			case 'trainStation':
				$area = new TrainStation($data);
				break;
			case 'port':
				$area = new Port($data);
				break;
		}
		$company->areas()->save($area);
		return response()->json([
			'data' => $area,
			'message' => 'The company was created successfully'
		],201);
	}

	/**
	 * Update the service area with the new data
	 * @param Request $request
	 * @param $id
	 *
	 * @return \Illuminate\Http\JsonResponse
	 */
	public function update(Request $request, $id) {
		$area = Area::findOrFail($id);
		$request->validate([
			'name' => 'required|max:255',
			'country' => 'required|max:255',
			'city' => 'required|max:255',
		]);
		$data = $request->all();
		$area->update($data);
		return response()->json([
			'data' => $area,
			'message' => 'Area updated successfully'
		],200);
	}
	/**
	 * Delete a service area
	 * @param $id
	 *
	 * @return \Illuminate\Http\JsonResponse
	 */
	public function destroy($id){
		$area = Area::findOrFail($id);
		$area->delete();
		return response()->json(null,204);
	}
}