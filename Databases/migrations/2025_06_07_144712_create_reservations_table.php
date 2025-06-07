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
        Schema::create('q_reservations', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('organization_id')->nullable();
            $table->unsignedBigInteger('list_id')->nullable();
            $table->string('name');
            $table->string('phone');
            $table->string('code');
            $table->date('date');
            $table->string('record_type');
            $table->string('record_status');
            $table->timestamps();

            $table->foreign('organization_id')->references('id')->on('q_organizations')->onDelete('restrict');
            $table->foreign('list_id')->references('id')->on('q_lists')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('q_reservations');
    }
};
