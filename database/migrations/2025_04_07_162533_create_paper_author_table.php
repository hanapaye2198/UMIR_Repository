<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('author_paper', function (Blueprint $table) {

            $table->id(); // optional, just to have a unique identifier (can remove if di kailangan)

            $table->foreignId('author_id')
                  ->constrained('authors')
                  ->onDelete('cascade');
            // use foreignId for cleaner FK declaration
            $table->foreignId('paper_id')
                  ->constrained('papers')
                  ->onDelete('cascade');


            // unique combination of paper and author
            $table->unique(['paper_id', 'author_id']);
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('paper_author');
    }
};
