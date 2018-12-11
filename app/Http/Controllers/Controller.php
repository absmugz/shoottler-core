<?php

namespace App\Http\Controllers;

use GuzzleHttp\Client;
use GuzzleHttp\Exception\BadResponseException;
use GuzzleHttp\Psr7\Response;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;

class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;

	/**
	 * Make an API Request
	 *
	 * @param $method
	 * @param $url
	 * @param array $params
	 *
	 * @return mixed|\Psr\Http\Message\ResponseInterface
	 * @throws \GuzzleHttp\Exception\GuzzleException
	 */
	protected function apiRequest($method, $url, $params =[]) {
		$client = new Client(['verify'=>config('services.guzzle.verify_cert')]);
		$response = $client->request($method, $url, $params);
		return $response;
	}

	/**
	 * Get an access token
	 *
	 * @param $clientId
	 * @param $clientSecret
	 * @param $grantType
	 * @param $url
	 * @param null $userName
	 * @param null $password
	 *
	 * @return \Illuminate\Http\JsonResponse|\Psr\Http\Message\StreamInterface
	 * @throws \GuzzleHttp\Exception\GuzzleException
	 */
	protected function getAccessToken($clientId, $clientSecret, $grantType, $url, $userName = null, $password = null) {
		$params = [
			'grant_type' => $grantType,
			'client_id' => $clientId,
			'client_secret' => $clientSecret,
			'username' => $userName,
			'password' => $password
		];
		try {
			$response = $this->apiRequest('POST', $url, ['form_params' => $params]);
			return $response->getBody();
		} catch (BadResponseException $exception) {
			if ($exception->getCode() === 400) {
				return response()->json(__('Invalid Request. Please enter a username or a password.'), $exception->getCode());
			} else if ($exception->getCode() === 401) {
				return response()->json(__('Your credentials are incorrect. Please try again'), $exception->getCode());
			}
			return response()->json(__('Something went wrong on the server.'), $exception->getCode());
		}
	}
}
