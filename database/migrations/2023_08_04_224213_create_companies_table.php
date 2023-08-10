<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCompaniesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('companies', function (Blueprint $table) {
            $table->string('id')->primary();
            $table->string('lastname');
            $table->string('firstname');
            $table->unsignedBigInteger('gender_id');
            $table->string('phone');
            $table->string('email')->unique();
            $table->string('name')->unique();
            $table->unsignedBigInteger('sector_id')->nullable();
            $table->unsignedBigInteger('country_id')->nullable();
            $table->unsignedBigInteger('city_id')->nullable();
            $table->string('password');
            $table->timestamps();

            $table->foreign('gender_id')->references('id')->on('genders')
                ->cascadeOnUpdate();
            $table->foreign('sector_id')->references('id')->on('sectors')
                ->cascadeOnUpdate();
            $table->foreign('country_id')->references('id')->on('countries')
                ->cascadeOnUpdate();
            $table->foreign('city_id')->references('id')->on('cities')
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
        Schema::dropIfExists('companies');
    }
}
