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
            $table->primary([
                'ID_USER',
                'ID_APP',
                ]);
            $table->unsignedInteger('ID_USER');
            $table->unsignedInteger('ID_APP');
            $table->time('Max time');
            $table->time('Start at');
            $table->time('Finish at');
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
