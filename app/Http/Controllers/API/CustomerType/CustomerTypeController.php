<?php
/**
 * Created by PhpStorm.
 * User: angelformica
 * Date: 2018-12-17
 * Time: 22:03
 */

namespace App\Http\Controllers\API\CustomerType;


use App\Http\Resources\CustomerTypesCollection;
use App\Models\Customer\Type\CustomerType;
use Illuminate\Http\Request;

class CustomerTypeController {

	/**
	 * List the Customer types
	 * @param Request $request
	 *
	 * @return CustomerTypesCollection
	 */
	public function index(Request $request){
		return new CustomerTypesCollection(CustomerType::search(trim($request->type))->get());
	}
}