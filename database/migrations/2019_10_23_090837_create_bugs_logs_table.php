<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateBugsLogsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('bugs_logs', function (Blueprint $table) {
            $table->bigIncrements('id');

            $table->unsignedBigInteger('bug_id');
            $table->integer('account_id');

            $table->string('logs', 250);

            $table->foreign('bug_id')->references('id')->on('bugs_tickets');

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('bugs_logs');
    }
}
