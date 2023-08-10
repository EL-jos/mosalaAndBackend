<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class DeleteMoreColumnInTableCompanies extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('companies', function (Blueprint $table) {
            $table->dropColumn('lastname');
            $table->dropColumn('firstname');
            $table->dropColumn('phone');
            $table->dropUnique('companies_email_unique');
            $table->dropColumn('email');
            $table->dropForeign('companies_gender_id_foreign');
            $table->dropColumn('gender_id');
            $table->dropForeign('companies_country_id_foreign');
            $table->dropColumn('country_id');
            $table->dropForeign('companies_city_id_foreign');
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
        Schema::table('companies', function (Blueprint $table) {
            //
        });
    }
}
