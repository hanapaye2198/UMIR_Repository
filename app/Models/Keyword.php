<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Keyword extends Model
{
    use HasFactory;
    protected $fillable = ['name'];

    public function papers()
    {
        return $this->belongsToMany(Paper::class, 'paper_keyword');
    }

}
