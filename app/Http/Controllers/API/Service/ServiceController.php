<?php
/**
 * Created by PhpStorm.
 * User: angelformica
 * Date: 2018-12-13
 * Time: 17:17
 */

namespace App\Http\Controllers\API\Service;

use App\Http\Resources\ServiceCollection;
use App\Http\Resources\ServiceResource;
use App\Models\Company\Company;
use App\Models\Items\Services\Service;
use Illuminate\Http\Request;

class ServiceController {
	public function index(Request $request){
		$company = Company::findOrFail($request->get('company_id'));
		return new ServiceCollection($company->services);
	}
	public function show($id){
		return new ServiceResource(Service::findOrFail($id));
	}
	public function store(Request $request){

	}
	public function update(Request $request,$id){

	}
	public function destroy($id){
		$service = Service::findOrFail($id);
		$service->delete();
		return response()->json(null,204);
	}
}