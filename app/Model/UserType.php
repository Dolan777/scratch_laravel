<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class UserType extends Model
{
    protected $table = 'user_type';
    protected $fillable = [
		        'id','type_name'
		    ];

		    protected $hidden = [
        'password,hash_password',
    ];

      public $timestamps = false;
}
