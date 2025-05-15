<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DownloadRequest extends Model
{
    use HasFactory;
    protected $fillable = [
    'paper_id',
    'user_id',
    'message',
    'requested_download_date',
    'status',
];

    public function paper()
{
    return $this->belongsTo(Paper::class);
}

public function user()
{
    return $this->belongsTo(User::class);
}
}
