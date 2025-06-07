<?php

namespace App\Models;

// use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;


class File extends Model
{
    // use HasFactory;

    protected $fillable = [
        'path',
        'book_id',
    ];



    public function book(): BelongsTo
    {
        return $this->belongsTo(book::class,'book_id','id');
    }
}
