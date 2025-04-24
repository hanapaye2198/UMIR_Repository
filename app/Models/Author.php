<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Author extends Model
{
    use HasFactory;
    protected $fillable = ['lastname', 'firstname'];
    public function papers()
    {
        return $this->belongsToMany(Paper::class, 'author_paper');
    }



    // Accessor for full name
    public function getFullNameAttribute()
    {
        return $this->lastname . ', ' . $this->firstname;
    }
}
