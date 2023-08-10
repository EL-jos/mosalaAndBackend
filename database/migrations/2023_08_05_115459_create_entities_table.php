<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateEntitiesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('entities', function (Blueprint $table) {
            $table->string('id')->primary();
            $table->string('entityable_id');
            $table->string('entityable_type');
            $table->string('lastname');
            $table->string('firstname');
            $table->unsignedBigInteger('gender_id');
            $table->string('phone');
            $table->string('email')->unique();
            $table->unsignedBigInteger('country_id')->nullable();
            $table->unsignedBigInteger('city_id')->nullable();
            $table->string('password');
            $table->timestamps();

            $table->foreign('gender_id')->references('id')->on('genders')
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
        Schema::dropIfExists('entities');
    }
}
