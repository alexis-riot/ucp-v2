<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateLogPanelsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('cp_logs', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->integer('account_id');
            $table->timestamp('timestamp')->useCurrent();
            $table->string('type', 30);
            $table->string('category', 50);
            $table->longText('message');

            $table->foreign('account_id')->references('id')->on('accounts');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('cp_logs');
    }
}
