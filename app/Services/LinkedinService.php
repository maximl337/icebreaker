<?php 

namespace App\Services;

use App\Contracts\Linkedin;

class LinkedinService implements Linkedin {

	public function getPerson($url, $token)
	{
		$url = 'https://api.linkedin.com/v1/people/url=' . $id;

		$params = [
			'format' => 'json'
		];

		$ch = curl_init($url . http_build_query($params));

		curl_setopt_array($ch, [
				CURLOPT_RETURNTRANSFER => true,
				CURLOPT_HTTPHEADER => [
						'Authorization: Bearer ' . $token
					],
			]);

		$response_json = curl_exec($ch);

        $response_obj  = json_decode($response_json);

		curl_close($ch);

		// get correct id from return response

		// make another curl call to https://api.linkedin.com/v1/people/id=<CORRECT ID GOES HERE>:(first-name,last-name,headline,interests,skills,educations,industry,positions)?format=json

		// parse and return information

	}
}