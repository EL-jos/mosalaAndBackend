<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTablePivotCityRequest extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('city_request', function (Blueprint $table) {
            $table->unsignedBigInteger('city_id');
            $table->string('request_id');

            $table->foreign('city_id')->references('id')->on('cities')
                ->cascadeOnDelete()
                ->cascadeOnUpdate();

            $table->foreign('request_id')->references('id')->on('requests')
                ->cascadeOnDelete()
                ->cascadeOnUpdate();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('city_request', function (Blueprint $table) {
            //
        });
    }
}
