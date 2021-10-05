<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ClientUser extends Model
{
    use HasFactory;
    protected $fillable = [
        "Client_User_FirstName",
        "Client_User_LastName",
        "Client_User_email",
        "Password",
        "image"
        ];

}
