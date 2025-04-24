<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Paper extends Model
{
    use HasFactory;
    protected $fillable = [
        'collection_id',
        'title',
        'date_of_issue',
        'publisher',
        'identifier',
        'type',
        'language',
        'abstract',
        'description',
        'file_path',
        'file_size',
        'file_description',
        'download_permission'
    ];
    protected $dates = ['date_of_issue'];

    public function collection()
    {
        return $this->belongsTo(Collection::class);
    }

    public function authors()
    {
        return $this->belongsToMany(Author::class, 'author_paper');
    }



    public function keywords()
    {
        return $this->belongsToMany(Keyword::class, 'paper_keyword');
    }



    // Helper method to get authors as "Lastname, Firstname" string
    public function getAuthorsListAttribute()
    {
        return $this->authors->map(function($author) {
            return $author->lastname . ', ' . $author->firstname;
        })->implode('; ');
    }

    // Helper method to get keywords as comma-separated string
    public function getKeywordsListAttribute()
    {
        return $this->keywords->pluck('name')->implode(', ');
    }
}
