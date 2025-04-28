<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('papers', function (Blueprint $table) {
            $table->id();
            $table->foreignId('collection_id')->constrained()->onDelete('cascade');
            $table->string('title');
            $table->string('other_title')->nullable();
            $table->date('date_of_issue')->nullable();
            $table->string('publisher')->nullable();
            $table->string('citation')->nullable();
            $table->string('series_name')->nullable();
            $table->string('report_number')->nullable();
            $table->string('identifier_type')->nullable();
            $table->string('identifier_value')->nullable();
            $table->string('type')->nullable();
            $table->string('language')->nullable();
            $table->text('abstract')->nullable();
            $table->text('description')->nullable();
            $table->string('file_path');
            $table->string('file_size')->nullable();
            $table->text('file_description')->nullable();
            $table->text('download_date')->nullable();
            $table->boolean('download_permission')->default(false);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('papers');
    }
};
