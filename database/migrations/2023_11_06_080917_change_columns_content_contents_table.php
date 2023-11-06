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
        Schema::table('content_contents', function (Blueprint $table) {
            $table->dropColumn('type');
            $table->dropColumn('link');
            $table->string('link_text')->nullable();
            $table->string('link_video')->nullable();
            $table->string('link_kaplan')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        //
    }
};
