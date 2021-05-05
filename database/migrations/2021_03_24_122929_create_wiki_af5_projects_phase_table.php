<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateWikiAf5ProjectsPhaseTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('wiki_af5_projects_phase', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('project_enviroment_id');
            $table->enum('name',['anteproyecto','desarrollo','retenido','mantenimiento','terminado'])->default('anteproyecto');
            $table->timestamps();
            $table->dateTime('deleted_at')->nullable();
            $table->foreign('project_enviroment_id')->references('id')->on('wiki_af5_projects_enviroments')->onUpdate('cascade')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('wiki_af5_projects_phase');
    }
}
