<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateWikiAf5WebServicesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('wiki_af5_web_services', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('project_id');
            $table->string('name');
            $table->enum('methods',['get','post','put','delete','head','connect','options','trace','patch']);
            $table->string('url');
            $table->text('data_headers');
            $table->enum('data_request_type',['json','text','other']);
            $table->text('data_request');
            $table->text('data_response');
            $table->timestamps();
            $table->dateTime('deleted_at')->nullable();
            $table->foreign('project_id')->references('id')->on('wiki_af5_projects')->onUpdate('cascade')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('wiki_af5_web_services');
    }
}
