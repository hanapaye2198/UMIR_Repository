<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Collection extends Model
{
    use HasFactory;
    protected $fillable = ['community_id', 'name', 'description'];

    public function community()
    {
        return $this->belongsTo(Community::class);
    }
    public function papers()
{
    return $this->hasMany(Paper::class);
}
}
