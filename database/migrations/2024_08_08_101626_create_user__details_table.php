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
        Schema::create('user__details', function (Blueprint $table) {
            $table->id();
            $table->string('rang_salary');
            $table->string('status_employee');
            $table->string('years_experience');
            $table->string('educational_level');
            $table->string('career_level');
            $table->string('type_job');
            $table->integer('scope_work_id');
            $table->integer('job_title_id');
            $table->integer('user_id');

           
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('user__details');
    }
};
