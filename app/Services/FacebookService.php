<?php

namespace App\Services;

use Facebook\Facebook;

class FacebookService {

	public function getPerson($url)
	{
		// $ch = curl_init($url);

		// curl_setopt_array($ch, [
		// 		CURLOPT_RETURNTRANSFER => true
		// 	]);

		// $response = curl_exec($ch);

		// curl_close($ch);

		$output = file_get_html($url);

		return $output;

	}
}