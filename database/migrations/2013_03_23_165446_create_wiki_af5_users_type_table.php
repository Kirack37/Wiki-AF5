<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateWikiAf5UsersTypeTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('wiki_af5_users_type', function (Blueprint $table) {
            $table->id()->index();
            $table->string('name');
            $table->string('description')->nullable()->default('null');
            $table->tinyInteger('status')->default('0');
            $table->timestamps();
            $table->dateTime('delete_at')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('wiki_af5_users_type');
    }
}
