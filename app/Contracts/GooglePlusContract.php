<?php

namespace App\Contracts;

interface GooglePlusContract {

	public function getPerson($token, $id);
}