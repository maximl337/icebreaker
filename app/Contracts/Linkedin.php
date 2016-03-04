<?php 

namespace App\Contracts;

interface Linkedin {

	public function getPerson($url, $token);
}