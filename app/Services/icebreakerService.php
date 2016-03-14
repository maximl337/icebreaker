<?php 

namespace App\Services;

use Auth;

class icebreakerService {


	public function getData($email, $name = "")
	{
		try {

			$fullcontact = $this->fullcontact($email);

			$response['fullcontact'] = $fullcontact;

			if(!empty($fullcontact['obj']->socialProfiles)) {
				
				$twitterExists = $this->checkIfTwitterUrlGiven($fullcontact['obj']->socialProfiles);
		
				if($twitterExists) {
		
					$userName = $twitterExists->username;
		
					$response['twitter'] = $this->getTwitterDataFromUserName($userName);
		
				}
		
				$linkedinExists = $this->checkIfLinkedinUrlGiven($fullcontact['obj']->socialProfiles);
		
				if($linkedinExists) {
		
					$url = !empty($linkedinExists->url) ? $linkedinExists->url : null;
					
					if(!is_null($url)) {

						$access_token = Auth::user()->accessTokens()->where('provider', 'linkedin')->latest()->first();
		
						$token = !empty($access_token->token) ? $access_token->token : null;
			
						if(!is_null($token)) {

							$linkedinData = (new \App\Services\LinkedinService)->getPerson($url, $token);

							if($linkedinData) {
								$response['linkedin'] = $linkedinData;
							}	
						}

					} // $url exists
	
				}

				$checkIfGooglePlusExists = $this->checkIfGooglePlusExists($fullcontact['obj']->socialProfiles);

				if($checkIfGooglePlusExists) {

					$googlePlusId = !empty($checkIfGooglePlusExists->id) ? $checkIfGooglePlusExists->id : null;

					if(!is_null($googlePlusId)) {

						$access_token = Auth::user()->accessTokens()->where('provider', 'google')->latest()->first();

						$token = !empty($access_token->token) ? $access_token->token : null;
			
						if(!is_null($token)) {

							$googleData = (new \App\Services\GooglePlusService)->getPerson($token, $googlePlusId);

							if($googleData) {
								$response['google'] = $googleData;
							}	
						}

					} // $googlePlusId exists
					
				}

			}

			// Website meta data
			if(!empty($fullcontact['obj']->contactInfo->websites)) {

				$response['websites'] = [];

				foreach($fullcontact['obj']->contactInfo->websites as $site) {

					if(!empty($site->url)) {

						$response['websites'][] = [
							'url' => $site->url,
							//'meta-data' => get_meta_tags($site->url)
						];
					}
					
				}

			} 

			return $response;

		} catch(\Exception $e) {

			throw $e;

		}
	}


	public function fullcontact($email)
	{
		$_baseUri = 'https://api.fullcontact.com/';

        $_version = 'v2';

        try {

        	$params['email'] = $email;    
        
        	$params['apiKey'] = env('FULLCONTACT_API_KEY');

        	$fullUrl = $_baseUri . $_version . '/person.json?' . http_build_query($params); 

        	$connection = curl_init($fullUrl);

        	curl_setopt($connection, CURLOPT_RETURNTRANSFER, 1);

        	$response_json = curl_exec($connection);

        	$response_code = curl_getinfo($connection, CURLINFO_HTTP_CODE);

        	$response_obj  = json_decode($response_json);

        	curl_close($connection);

        	return [
        		'obj' => $response_obj,
        		'json' => $response_json,
        		'code' => $response_code
        	];

        } catch(\Exception $e) {
        	throw $e;
        }

	}

	public function checkIfTwitterUrlGiven(array $data)
	{

		foreach($data as $socialProfile) {
			if($socialProfile->typeName == "Twitter") {

				return $socialProfile;
			}
		}

		return false;
	}

	public function checkIfLinkedinUrlGiven(array $data)
	{
		foreach($data as $socialProfile) {
			if($socialProfile->typeName == "LinkedIn") {

				return $socialProfile;
			}
		}

		return false;
	}

	public function checkIfGooglePlusExists(array $data)
	{
		foreach($data as $socialProfile) {
			if($socialProfile->typeName == "GooglePlus") {

				return $socialProfile;
			}
		}

		return false;
	}

	public function getTwitterBearerTokenObject()
	{

		try {

			$key = urlencode(env('TWITTER_CONSUMER_KEY'));

			$secret = urlencode(env('TWITTER_CONSUMER_SECRET'));

			$authString = base64_encode($key . ":" . $secret);

			$host = 'https://api.twitter.com';

			$resource = '/oauth2/token';

			$ch = curl_init($host.$resource);

			curl_setopt_array($ch, [
					CURLOPT_POST => true,
					CURLOPT_RETURNTRANSFER => 1, 
					CURLOPT_HTTPHEADER => [
						'Authorization: Basic ' . $authString,
						'Content-type: application/x-www-form-urlencoded;charset=UTF-8'
					],
					CURLOPT_POSTFIELDS => 'grant_type=client_credentials'	
				]);

			$response_json = curl_exec($ch);

			$response_code = curl_getinfo($ch, CURLINFO_HTTP_CODE);

	        $response_obj  = json_decode($response_json);

			curl_close($ch);

			return [
	        		'obj' 	=> $response_obj,
	        		'json' 	=> $response_json,
	        		'code' 	=> $response_code
	        	];

		} catch(\Exception $e) {

			throw $e;

		}
		
	}

	public function getTwitterDataFromUserName($userName)
	{
		try {

			$bearerTokenArray = $this->getTwitterBearerTokenObject();

			$bearerTokenObject = $bearerTokenArray['obj'];
			
			if(empty($bearerTokenObject->access_token) || $bearerTokenObject->token_type != 'bearer') {
				throw new Exception("Access token not given or token type invalid");
			}

			$bearerToken = $bearerTokenObject->access_token;

			$params = [
				'screen_name' => $userName
			];

			$url = 'https://api.twitter.com/1.1/users/lookup.json?' . http_build_query($params);

			$ch = curl_init($url);

			curl_setopt_array($ch, [
					CURLOPT_RETURNTRANSFER => true,
					CURLOPT_RETURNTRANSFER => 1, 
					CURLOPT_HTTPHEADER => [
						'Authorization: Bearer ' . $bearerToken
					],
				]);

			$response_json = curl_exec($ch);

			$response_code = curl_getinfo($ch, CURLINFO_HTTP_CODE);

	        $response_obj  = json_decode($response_json);

			curl_close($ch);

			return [
	        		'obj' 	=> $response_obj,
	        		'json' 	=> $response_json,
	        		'code' 	=> $response_code
	        	];

		} catch(\Exception $e) {

			throw $e;

		}
		
	}
}