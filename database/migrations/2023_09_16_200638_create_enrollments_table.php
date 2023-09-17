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
        Schema::create('enrollments', function (Blueprint $table) {
            $table->id('cus_id');
            $table->string('cus_name');
            $table->string('cus_surname');
            $table->string('cus_email');
            $table->date('cus_birthdate');
            $table->string('cus_tel');
            $table->string('cus_facebook');
            $table->string('cus_line');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('enrollments');
    }
};
