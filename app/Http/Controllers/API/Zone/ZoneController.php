<?php
/**
 * Created by PhpStorm.
 * User: angelformica
 * Date: 2018-11-29
 * Time: 15:10
 */

namespace App\Http\Controllers\API\Zone;

use App\Http\Resources\ZoneCollection;
use App\Http\Resources\ZoneResource;
use App\Models\Area\Area;
use App\Models\Area\Zone;
use App\Models\Company\Company;
use Illuminate\Http\Request;

class ZoneController {

	/**
	 * List the zones of the given company
	 * @param Request $request
	 *
	 * @return ZoneCollection
	 */
	public function index(Request $request){
		$company = Company::findOrFail($request->query('company_id'));
		return new ZoneCollection($company->zones);
	}

	/**
	 * Create the zone for the given service area
	 * @param Request $request
	 *
	 * @return \Illuminate\Http\JsonResponse
	 */
	public function store(Request $request){
		$request->validate([
			'area' => 'required',
			'name' => 'required|min:8|max:255',
		]);
		$area = Area::findOrFail($request->get('area'));
		$zone = new Zone([
			'name' => $request->get('name')
		]);
		$area->zones()->save($zone);
		return response()->json([
			'zone' => $zone,
			'message' => 'Zone created successfully'
		],200);
	}

	/**
	 * Show the requested zone
	 * @param $id
	 *
	 * @return ZoneResource
	 */
	public function show($id){
		return new ZoneResource(Zone::findOrFail($id));
	}

	/**
	 * Delete a zone
	 * @param $id
	 *
	 * @return \Illuminate\Http\JsonResponse
	 */
	public function destroy($id){
		$zone = Zone::findOrFail($id);
		$zone->delete();
		return response()->json(null,204);
	}
}