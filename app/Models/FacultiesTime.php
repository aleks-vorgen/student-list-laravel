<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class FacultiesTime extends Model
{
    use HasFactory;

    protected $fillable = [
        'faculty_id',
        'work_date',
    ];
}
