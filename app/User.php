<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Database\Eloquent\Model;

class User extends Authenticatable
{
    use Notifiable;

    public $timestamps = false;

    protected $guarded = [];

    protected $hidden = [
        'password', 'remember_token', 'created_at', 'updated_at'
    ];



}
