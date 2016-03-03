<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Search extends Model
{
    protected $table = 'searches';

    protected $fillable = [
    	'user_id',
    	'name',
    	'email',
    	'location',
    	'data'
    ];
}
