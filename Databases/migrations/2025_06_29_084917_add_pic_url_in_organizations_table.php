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
        Schema::table('q_organizations', function (Blueprint $table) {
            //
            $table->string('pic_url')->nullable();
            $table->text('description')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('q_organizations', function (Blueprint $table) {
            //
            $table->dropColumn([
                'pic_url',
                'description'
            ]);
        });
    }
};
