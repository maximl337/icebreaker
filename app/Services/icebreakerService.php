<?php 

namespace App\Services;

class icebreakerService {


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

	public function facebook()
	{
		# code...
	}

	public function twitter()
	{
		# code...
	}

	public function googleplus()
	{
		# code...
	}

	public function linkedIn()
	{
		# code...
	}

	public function googleCustomSearch()
	{
		# code...
	}
}