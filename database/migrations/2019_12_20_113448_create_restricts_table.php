<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateRestrictsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('restricts', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('id_user')->references('id')->on('users');
            $table->unsignedInteger('id_app')->references('id')->on('applications');
            $table->time('max_time')->nullable();
            $table->time('start_at')->nullable();
            $table->time('finish_at')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('restricts');
    }
}
