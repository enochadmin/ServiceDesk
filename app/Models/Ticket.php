<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Project;
use App\Models\Client;

class Ticket extends Model
{
    use HasFactory;

    protected $fillable = [
        "Issue",
        "Description",
        "document",
        "project_id",
        "Tag_id",
        "Priorty",
        "Date",
        "ticket_status"
    ];

}
