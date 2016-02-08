<?php

namespace App\Models;


use App\Model;

class User extends Model
{
    public $email;
    public $name;

    const TABLE = 'users';

}