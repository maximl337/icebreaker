<?php

namespace App\Services;

use App\Contracts\GooglePlusContract;

class GooglePlusService implements GooglePlusContract {

	public function getPerson($token, $id)
	{
		$url = 'https://www.googleapis.com/plus/v1/people/' . $id . '?';

		$params = [
			'access_token' 	=> $token,
			'key'			=> env('GOOGLE_CONSUMER_KEY')
		];

		try {

			$ch = curl_init($url . http_build_query($params));

			curl_setopt_array($ch, [
					CURLOPT_RETURNTRANSFER => true
				]);

			$response_json = curl_exec($ch);

			$response_obj = json_decode($response_json);

			curl_close($ch);

			return $response_obj;

		} catch(\Exception $e) {

			return false;
		}

	}
}