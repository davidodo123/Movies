<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Movie extends Model
{
    use HasFactory;

    protected $fillable = ['title', 'synopsis', 'year', 'director_id', 'path'];

    public function director()
    {
        return $this->belongsTo(Director::class);
    }

    public function reviews()
    {
        return $this->hasMany(Review::class);
    }
}
