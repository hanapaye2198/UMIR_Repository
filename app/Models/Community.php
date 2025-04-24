<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Community extends Model
{
    use HasFactory;
    protected $fillable = ['name', 'description', 'logo'];

    public function collections()
    {
        return $this->hasMany(Collection::class);
    }
    public function papers()
    {
        return $this->hasManyThrough(Paper::class, Collection::class);
    }
}
