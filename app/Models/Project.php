<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Project extends Model
{
    use HasFactory;
    // if your table is not tables then user the following syntax to define your table
    // protected $table = 'my_tables';
    protected $fillable = [
        "name","client_id","projectStatus","startDate","dueDate","documents"
    ];

}
