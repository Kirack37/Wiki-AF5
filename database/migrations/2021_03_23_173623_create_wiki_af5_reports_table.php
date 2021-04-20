<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateWikiAf5ReportsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('wiki_af5_reports', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('meeting_id');
            $table->tinyInteger('aprobbed')->default('0');
            $table->text('description');
            $table->enum('publication',['publicado','borrador','denegado'])->default('borrador');
            $table->timestamps();
            $table->dateTime('deleted_at')->nullable();
            $table->foreign('meeting_id')->references('id')->on('wiki_af5_meetings')->onUpdate('cascade')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('wiki_af5_reports');
    }
}
