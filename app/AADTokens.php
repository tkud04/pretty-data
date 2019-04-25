<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class AADTokens extends Model
{

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'client_id', 'access_token', 'refresh_token', 'token_expires','oauth_state'
    ];
    
    protected $table = 'aadtokens';
}
