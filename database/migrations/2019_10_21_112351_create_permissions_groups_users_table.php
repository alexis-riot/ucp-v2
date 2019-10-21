<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePermissionsGroupsUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('permissions_groups_users', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->integer('account_id');
            $table->unsignedBigInteger('group_id');
            $table->foreign('group_id')->references('id')->on('permissions_groups');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('permissions_groups_users');
    }
}
