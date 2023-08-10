<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePivotTableCompetencyStudent extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('competency_student', function (Blueprint $table) {
            $table->unsignedBigInteger('competency_id');
            $table->string('student_id');

            $table->foreign('competency_id')->references('id')->on('competencies')
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
        Schema::table('competency_student', function (Blueprint $table) {
            //
        });
    }
}
