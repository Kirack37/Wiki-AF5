<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateWikiAf5EntityPermissionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('wiki_af5_entity_permissions', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('entity_id');
            $table->unsignedBigInteger('permission_id');
            $table->timestamps();
            $table->dateTime('deleted_at')->nullable();
            $table->foreign('entity_id')->references('id')->on('wiki_af5_entities')->onUpdate('cascade')->onDelete('cascade');
            $table->foreign('permission_id')->references('id')->on('wiki_af5_permissions')->onUpdate('cascade')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('wiki_af5_entity_permissions');
    }
}
