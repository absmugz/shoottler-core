<?php
/**
 * Created by PhpStorm.
 * User: angelformica
 * Date: 11/21/18
 * Time: 9:42 PM
 */

namespace App\Http\Controllers\API\User;

use App\Http\Controllers\Controller;
use App\Http\Resources\DatabaseNotificationCollection;
use App\Http\Resources\UserResource;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\ResourceCollection;

class UserController extends Controller {
	/**
	 * The authenticated settings
	 * @param Request $request
	 *
	 * @return UserResource
	 */
	public function show(Request $request){
		return new UserResource($request->user());
	}
	/**
	 * The settings's notifications
	 * @param Request $request
	 *
	 * @return ResourceCollection
	 */
	public function notifications(Request $request){
		$perPage = $request->get('per_page',null);
		return new DatabaseNotificationCollection($request->user()->notifications()->paginate($perPage));
	}
}