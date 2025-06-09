<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Payment extends Model
{
    protected $fillable = [
        'amount',
        'number',
        'student_id',
    ];

    public function student()
    {
        return $this->belongsTo(student::class);
    }
}
