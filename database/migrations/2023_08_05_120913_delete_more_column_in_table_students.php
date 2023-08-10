<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class DeleteMoreColumnInTableStudents extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('students', function (Blueprint $table) {
            $table->dropColumn('lastname');
            $table->dropColumn('firstname');
            $table->dropColumn('phone');
            $table->dropUnique('students_email_unique');
            $table->dropColumn('email');
            $table->dropForeign('students_gender_id_foreign');
            $table->dropColumn('gender_id');
            $table->dropForeign('students_country_id_foreign');
            $table->dropColumn('country_id');
            $table->dropForeign('students_city_id_foreign');
            $table->dropColumn('city_id');
            $table->dropColumn('password');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('students', function (Blueprint $table) {
            //
        });
    }
}
