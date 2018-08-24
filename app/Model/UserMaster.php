<?php

namespace App\Model;

use Illuminate\Contracts\Auth\Authenticatable;
use Illuminate\Database\Eloquent\Model;

class UserMaster extends Model implements Authenticatable {

    use \Illuminate\Auth\Authenticatable;

    public $confirm_password;
    protected $table = 'user_master';
    protected $fillable = [
        'id', 'type_id', 'full_name', 'email', 'phone', 'social_id', 'reg_type', 'status', 'remember_token', 'forget_password_token', 'activation_token', 'created_at', 'updated_at'
    ];
    protected $hidden = [
        'password', 'hash_password'
    ];

}
