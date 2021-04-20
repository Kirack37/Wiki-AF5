<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateWikiAf5ProjectsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('wiki_af5_projects', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('responsible_id');
            $table->unsignedBigInteger('priority_id');
            $table->date('start_date');
            $table->date('end_date')->nullable();
            $table->text('description');
            $table->string('name');
            $table->string('alias')->nullable();
            $table->timestamps();
            $table->dateTime('deleted_at')->nullable();
            $table->foreign('responsible_id')->references('id')->on('users')->onUpdate('cascade')->onDelete('cascade');
            $table->foreign('priority_id')->references('id')->on('wiki_af5_priorities')->onUpdate('cascade')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('wiki_af5_projects');
    }
}
