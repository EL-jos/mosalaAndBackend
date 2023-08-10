<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateRequestsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('requests', function (Blueprint $table) {
            $table->string('id')->primary();
            $table->string('student_id');
            $table->string('title');
            $table->text('content');
            $table->unsignedBigInteger('type_id');
            $table->unsignedBigInteger('city_id');
            $table->unsignedBigInteger('sector_id');
            $table->timestamps();

            $table->foreign('student_id')->references('id')->on('students')
                ->cascadeOnUpdate()
                ->cascadeOnDelete();

            $table->foreign('type_id')->references('id')->on('types')
                ->cascadeOnUpdate()
                ->cascadeOnDelete();

            $table->foreign('city_id')->references('id')->on('cities')
                ->cascadeOnUpdate()
                ->cascadeOnDelete();

            $table->foreign('sector_id')->references('id')->on('sectors')
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
        Schema::dropIfExists('requests');
    }
}
