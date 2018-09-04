<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePeopleTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('people', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name', 100);
            $table->string('email');
            $table->decimal('phone',11,0);
            $table->date('birth_date')->index('birth_date');

            $table->unsignedInteger('profile_id')->index('profile_id');
            $table->foreign('profile_id')->on('profiles')->references('id');

            $table->unsignedInteger('schooling_id')->index('schooling_id');
            $table->foreign('schooling_id')->on('schoolings')->references('id');

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
        Schema::dropIfExists('people');
    }
}
