<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCourDepartementPivotTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('cour_departement', function (Blueprint $table) {
            $table->integer('cour_id')->unsigned()->index();
            $table->foreign('cour_id')->references('id')->on('cours')->onDelete('cascade');
            $table->integer('departement_id')->unsigned()->index();
            $table->foreign('departement_id')->references('id')->on('departements')->onDelete('cascade');
            $table->primary(['cour_id', 'departement_id']);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('cour_departement');
    }
}
