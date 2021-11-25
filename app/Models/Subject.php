<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Subject extends Model
{
    use HasFactory;

    public $timestamps = false;

    function grievances() {
        return $this->hasMany(Grievance::class);
    }

    function officers() {
        return $this->hasMany(Officer::class);
    }
}
