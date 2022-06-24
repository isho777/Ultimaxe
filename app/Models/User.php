<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Laravel\Passport\HasApiTokens; // include this

class User extends Model //  extends Authenticatable  // 
{
	//use Notifiable, HasApiTokens; // update this line
	//use  HasApiTokens; // update this line
	
    protected $table = 'users';

    //protected $fillable = ['id', 'name', 'api_token','remember_token'];  //original
	protected $fillable = ['id','name', 'email', 'password', 'api_token'];  //ishmael
	
	protected $forceFill = ['api_token'];
}
