<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCoursTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('cours', function(Blueprint $table) {
            $table->increments('id');
            $table->string('title');
            $table->text('body');
            $table->timestamp('published_at');

            $table->integer('category_id')->unsigned();
            $table->foreign('category_id')->references('id')->on('categories');

           /* $table->integer('user_id')->unsigned();
            $table->foreign('user_id')->references('id')->on('users');*/

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
        Schema::drop('cours');
    }
}
