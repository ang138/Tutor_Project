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
        Schema::create('advisors', function (Blueprint $table) {
            $table->id('advisor_id');
            $table->string('advisor_name');
            $table->string('advisor_surname');
            $table->string('advisor_email')->unique();
            $table->string('advisor_password');
            $table->string('advisor_status');
            $table->string('advisor_faculty');
            $table->string('advisor_major');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('advisors');
    }
};
