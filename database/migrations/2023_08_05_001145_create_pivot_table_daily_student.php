<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePivotTableDailyStudent extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('daily_student', function (Blueprint $table) {
            $table->string('daily_id');
            $table->string('student_id');

            $table->foreign('daily_id')->references('id')->on('dailies')
                ->cascadeOnUpdate()
                ->cascadeOnDelete();
            $table->foreign('student_id')->references('id')->on('students')
                ->cascadeOnUpdate()
                ->cascadeOnDelete();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('daily_student', function (Blueprint $table) {
            //
        });
    }
}
