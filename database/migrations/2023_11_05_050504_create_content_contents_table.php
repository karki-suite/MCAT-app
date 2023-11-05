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
            $table->enum('type', ['Video', 'Text', 'Kaplan']);
            $table->enum('subcategory', ['Overview', 'Content', 'Review']);
            $table->enum('tracking', ['Checkbox', 'Percentage', 'None']);
            $table->string('label');
            $table->string('link');
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
