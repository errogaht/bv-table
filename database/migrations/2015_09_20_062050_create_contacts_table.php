<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateContactsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('contacts', function (Blueprint $table) {
            $table->increments('id');

            $table->date('date');

            $table->string('name');
            $table->string('phone');
            $table->string('email');
            $table->string('city');
            $table->string('metro');
            $table->integer('age');
            $table->text('how_long');
            $table->text('preferred_date');
            $table->text('comment');
            $table->string('status');
            $table->string('from');
            $table->dateTime('call_date');

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
        Schema::drop('contacts');
    }
}
