<?php
/**
 * Created by PhpStorm.
 * User: angelformica
 * Date: 2018-12-14
 * Time: 17:44
 */

namespace App\Http\Controllers\API\ItemType;


use App\Http\Controllers\Controller;
use App\Http\Resources\ItemTypesCollection;
use App\Models\Items\ItemType;
use Illuminate\Http\Request;

class ItemTypeController extends Controller {

	/**
	 * List the Item types
	 *
	 * @param Request $request
	 *
	 * @return ItemTypesCollection
	 */
	public function index(Request $request){
		return new ItemTypesCollection(ItemType::search(trim($request->type))->get());
	}
}