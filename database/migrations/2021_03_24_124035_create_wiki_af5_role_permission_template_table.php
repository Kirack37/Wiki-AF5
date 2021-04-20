<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateWikiAf5RolePermissionTemplateTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('wiki_af5_role_permission_template', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('role_id');
            $table->unsignedBigInteger('entity_permission_id');
            $table->timestamps();
            $table->dateTime('deleted_at')->nullable();
            $table->foreign('role_id')->references('id')->on('wiki_af5_roles')->onUpdate('cascade')->onDelete('cascade');
            $table->foreign('entity_permission_id')->references('id')->on('wiki_af5_entity_permissions')->onUpdate('cascade')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('wiki_af5_role_permission_template');
    }
}
