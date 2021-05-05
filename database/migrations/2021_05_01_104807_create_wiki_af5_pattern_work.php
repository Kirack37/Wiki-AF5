<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateWikiAf5PatternWork extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('wiki_af5_pattern_work', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->enum('project_type',['Pequeño','Mediano','Grande'])->nullable();
            $table->text('patterns');
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
        Schema::dropIfExists('wiki_af5_pattern_work');
    }
}
