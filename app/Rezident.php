<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Hash;
use Illuminate\Foundation\Auth\User as Authenticatable;

class Rezident extends Model
{
    protected $hidden = ['password'];
    
    public function validateForPassportPasswordGrant($password)
    {
        if (Hash::check($password, $this->password))
            return true;
        
        if (decrypt($password) == 'oauth')
            return true;
    }
}
