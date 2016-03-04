<?php

namespace App\Contracts;

interface Twitter {

	public function getPerson($token, $token_secret, $userName);

}