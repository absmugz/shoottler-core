<?php
/**
 * Created by PhpStorm.
 * User: angelformica
 * Date: 11/22/18
 * Time: 10:49 PM
 */

namespace App\Http\Controllers\API\Company;

use App\Company;
use App\Http\Resources\CompanyCollection;
use App\Http\Resources\CompanyResource;
use Illuminate\Http\Request;

class CompanyController {

	/**
	 * The authenticated user's companies
	 * @param Request $request
	 *
	 * @return CompanyCollection
	 */
	public function index(Request $request){
		return new CompanyCollection($request->user()->companies);
	}
	/**
	 * Show the requested company
	 * @param Request $request
	 * @param $id
	 *
	 * @return CompanyResource
	 */
	public function show(Request $request, $id) {
		return new CompanyResource($request->user()->companies()->where('company_id',$id)->get());
	}
	/**
	 * Create a new company for the authenticated user
	 * @param Request $request
	 *
	 * @return Company
	 */
	public function store(Request $request){
		$request->validate([
			'name' => 'required|string|max:255',
			'brand' => 'required|string|max:255',
			'website' => 'required|string|max:255|url',
		]);
		$data = $request->all();
		$company = new Company($data);
		$company->save();
		$request->user()->companies()->attach($company);
		return response()->json([
			'data' => $company,
			'message' => 'The company was created successfully'
		],201);
	}

	/**
	 * Update a company
	 * @param Request $request
	 * @param $id
	 *
	 * @return \Illuminate\Http\JsonResponse
	 */
	public function update(Request $request, $id){
		$request->validate([
			'name' => 'required|string|max:255',
			'brand' => 'required|string|max:255',
			'website' => 'required|string|max:255|url',
		]);
		$data = $request->all();
		$company = $request->user()->companies()->where('company_id',$id)->firstOrFail();
		$company->update($data);
		return response()->json([
			'data' => $company,
			'message' => 'Company updated successfully'
		],200);
	}
	/**
	 * Delete a company
	 * @param Request $request
	 * @param $id
	 *
	 * @return \Illuminate\Http\JsonResponse
	 */
	public function destroy(Request $request, $id){
		$company = $request->user()->companies()->where('company_id',$id)->firstOrFail();
		$company->delete();
		if ($request->user()->default_company_id == $id) {
			$request->user()->default_company_id = null;
			$request->user()->save();
		}
		return response()->json(null,204);
	}
	/**
	 * Set the authenticated user's default company
	 * @param Request $request
	 *
	 * @return \Illuminate\Http\JsonResponse
	 */
	public function setDefault(Request $request){
		$request->validate([
			'company_id' => 'required|exists:companies,id'
		]);
		$request->user()->setDefaultCompany(Company::find($request->get('company_id')));
		return response()->json([
			'data' => [
				'company_id' => $request->get('company_id')
			],
			'message' =>'Default company saved successfully'
		],200);
	}
	/**
	 * Get the authenticated user's default company
	 * @param Request $request
	 *
	 * @return CompanyResource
	 */
	public function getDefault(Request $request){
		if ($request->user()->default_company_id) {
			return new CompanyResource(Company::find($request->user()->default_company_id));
		} else {
			return new CompanyResource($request->user()->companies()->first());
		}
	}
}