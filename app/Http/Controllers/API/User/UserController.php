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
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rule;

class UserController extends Controller {
	/**
	 * The user
	 * @param Request $request
	 *
	 * @return UserResource
	 */
	public function show(Request $request){
		return new UserResource($request->user());
	}
	/**
	 * The user's notifications
	 * @param Request $request
	 *
	 * @return ResourceCollection
	 */
	public function notifications(Request $request){
		$perPage = $request->get('per_page',null);
		return new DatabaseNotificationCollection($request->user()->notifications()->paginate($perPage));
	}

	/**
	 * Update the user profile
	 *
	 * @param Request $request
	 *
	 * @return \Illuminate\Http\JsonResponse
	 */
	public function update(Request $request){
		$request->validate([
			'name' => 'required|max:255',
			'email' => [
				'required',
				'email',
				Rule::unique('users','email')->ignore($request->user()->id,'id')
				]
			]
		);
		$data = $request->all();
		if($request->has('password')){
			$data['password'] = Hash::make($request->password);
		}
		$request->user()->update($data);
		return response()->json([
			'data' => $request->user(),
			'message' => 'User updated successfully'
		],200);
	}
}