<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Request extends Model
{

    protected $fillable = [
        'day',
        'student_id',
        'book_id',
    ];

    public function student(){
        return $this->belongsTo(student::class);
    }

    public function book(){
        return $this->belongsTo(book::class);
    }
}
