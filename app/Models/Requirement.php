<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Requirement extends Model
{
    
     use HasFactory;

    //habilitamos asignacion masiva de propiedades
    protected $fillable = [
        'name',
        'course_id',
    ];
}
