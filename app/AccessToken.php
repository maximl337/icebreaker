<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class AccessToken extends Model
{
    protected $table = 'access_tokens';

    protected $fillable = [
    	'user_id',
    	'provider',
    	'provider_id',
    	'username',
    	'token',
        'token_secret'
    ];

    /**
     * Get linkedin access token
     * @return [type] [description]
     */
    public function scopeLinkedin()
    {
    	return $query->where('provider', 'linkedin');
    }

    public function user()
    {
    	return $this->belongsTo('App\User');
    }
}
