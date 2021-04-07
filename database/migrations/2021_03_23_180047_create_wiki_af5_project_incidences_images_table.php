<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateWikiAf5ProjectIncidencesImagesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('wiki_af5_project_incidences_images', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('incidence_id');
            $table->string('image');
            $table->timestamps();
            $table->dateTime('delete_at')->nullable();
            $table->foreign('incidence_id')->references('id')->on('wiki_af5_project_incidences')->onUpdate('cascade')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('wiki_af5_project_incidences_images');
    }
}
