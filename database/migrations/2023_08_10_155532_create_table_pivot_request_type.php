<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTablePivotRequestType extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('request_type', function (Blueprint $table) {
            $table->string('request_id');
            $table->unsignedBigInteger('type_id');

            $table->foreign('type_id')->references('id')->on('types')
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
        Schema::table('request_type', function (Blueprint $table) {
            //
        });
    }
}
