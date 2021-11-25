<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Grievance extends Model
{
    use HasFactory;

    function student() {
        return $this->belongsTo(Student::class);
    }

    function subject() {
        return $this->belongsTo(Subject::class);
    }

    function officer() {
        return $this->belongsTo(Officer::class);
    }
}
