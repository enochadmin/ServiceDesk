<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Project;
use App\Models\Ticket;
use App\Models\User;


class Client extends Model
{
    use HasFactory;

    protected $fillable = [
        "ClientName",
        "ClientAddress",
        "Website",
        "Representative_FirstName",
        "Representative_LastName",
        "Representative_email",
        "is_active"
    ];


    // client has many tickets
    public function tickets(){
        return $this->hasMany("App\Models\Ticket");

    }
    // client has many projects
    public function projects(){
        return $this->hasMany("App\Models\Project");
    }

    // client has many userss
    public function users(){
        return $this->hasMany("App\Models\User");
    }




}
