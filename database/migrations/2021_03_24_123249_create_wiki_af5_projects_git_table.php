<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateWikiAf5ProjectsGitTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('wiki_af5_projects_git', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('project_enviroment_id');
            $table->string('repository_url');
            $table->string('repository_name');
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
        Schema::dropIfExists('wiki_af5_projects_git');
    }
}
