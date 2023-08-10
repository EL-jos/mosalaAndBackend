<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class RemoveBacIDInStudentsTableAndAddStudentIdInBacsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('students', function (Blueprint $table) {
            $table->dropForeign('students_bac_id_foreign');
            $table->dropColumn('bac_id');
        });
        Schema::table('bacs', function (Blueprint $table) {
            $table->string('student_id')->unique();
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

    }
}
