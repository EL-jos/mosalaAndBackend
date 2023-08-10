<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePivotTablePeriodicalStudent extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('periodical_student', function (Blueprint $table) {
            $table->string('periodical_id');
            $table->string('student_id');

            $table->foreign('periodical_id')->references('id')->on('periodicals')
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
        Schema::table('periodical_student', function (Blueprint $table) {
            //
        });
    }
}
