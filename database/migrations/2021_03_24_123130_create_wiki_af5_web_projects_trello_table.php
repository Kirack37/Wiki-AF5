<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateWikiAf5WebProjectsTrelloTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('wiki_af5_web_projects_trello', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('project_enviroment_id');
            $table->string('url');
            $table->string('username');
            $table->string('password');
            $table->timestamps();
            $table->dateTime('delete_at')->nullable();
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
        Schema::dropIfExists('wiki_af5_web_projects_trello');
    }
}
