<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateInterviewShedulesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('interview_shedules', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->integer('user_id');
            $table->string('company_name')->nullable();
            $table->string('hr_name')->nullable();
            $table->string('contact_number')->nullable();
            $table->string('location')->nullable();
            $table->longText('description')->nullable();
            $table->integer('status')->default(0)->comment('0 Not shedule 1 first round clear 2 is second round clear 3 is hold');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('interview_shedules');
    }
}
