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
        Schema::create('students', function (Blueprint $table) {
            $table->id('std_id');
            $table->string('std_name');
            $table->string('std_surname');
            $table->string('std_email')->unique();
            $table->string('std_password');
            $table->string('std_status');
            $table->string('std_faculty');
            $table->string('std_major');
            $table->string('std_class');
            $table->decimal('std_gpax', 4, 2)->nullable();
            $table->string('std_grade')->nullable();
            $table->date('birthdate');
            $table->string('std_tel')->nullable();
            $table->string('std_facebook')->nullable();
            $table->string('std_line')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('students');
    }
};
