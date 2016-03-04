<?php 

namespace App\Services;

use App\Contracts\Linkedin;

class LinkedinService implements Linkedin {

	public function getPerson($url, $token)
	{

		try {

			$url = 'https://api.linkedin.com/v1/people/url=' . urlencode($url);

			$params = [
				'format' => 'json'
			];

			$ch = curl_init($url . '?' . http_build_query($params));

			curl_setopt_array($ch, [
					CURLOPT_RETURNTRANSFER => true,
					CURLOPT_HTTPHEADER => [
							'Authorization: Bearer ' . $token
						],
				]);

			$response_json = curl_exec($ch);

	        $response_obj  = json_decode($response_json);

	        curl_close($ch);

	        if(empty($response_obj->id)) throw new Exception("Linkedin id not found");


			$id = $response_obj->id;

			$url2 = 'https://api.linkedin.com/v1/people/id='.$id.':(first-name,last-name,headline,industry,distance,num-connections,summary,specialties,picture-url,current-share,interests,skills,educations,courses,associations,positions)?';


			$ch2 = curl_init($url2 . http_build_query($params));

			curl_setopt_array($ch2, [
					CURLOPT_RETURNTRANSFER => true,
					CURLOPT_HTTPHEADER => [
							'Authorization: Bearer ' . $token
						],
				]);

			$response = json_decode(curl_exec($ch2));

			return $response;

		} catch(\Exception $e) {

			throw $e;
			
		}
		

	}
}