<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Officer extends Model
{
    use HasFactory, SoftDeletes;

    public $timestamps = false;

    function grievances() {
        return $this->hasMany(Grievance::class);
    }

    function subject() {
        return $this->belongsTo(Subject::class);
    }
}
