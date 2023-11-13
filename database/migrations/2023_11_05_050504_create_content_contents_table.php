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
        Schema::create('content_contents', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('category_id');
            $table->enum('subcategory', ['OVERVIEW', 'CONTENT', 'REVIEW', 'PRACTICE', 'CARS']);
            $table->enum('tracking', ['CHECKBOX', 'PERCENTAGE', 'TEXTAREA', 'NONE']);
            $table->string('label');
            $table->string('link_text')->nullable();
            $table->string('ref_text')->nullable();
            $table->string('link_video')->nullable();
            $table->string('ref_kaplan')->nullable();
            $table->text('notes');
            $table->foreign('category_id')->references('id')->on('content_groups_categories');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('content_contents');
    }
};
