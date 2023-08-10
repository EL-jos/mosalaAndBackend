<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePivotTableFormationStudent2 extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('formation_student', function (Blueprint $table) {
            $table->string('formation_id');
            $table->string('student_id');

            $table->foreign('formation_id')->references('id')->on('formations')
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
        Schema::table('formation_student', function (Blueprint $table) {
            //
        });
    }
}
