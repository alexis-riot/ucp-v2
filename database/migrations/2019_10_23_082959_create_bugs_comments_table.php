<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateBugsCommentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('cp_bugs_comments', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('bug_id');

            $table->unsignedInteger('account_id');
            $table->text('comment');

            $table->foreign('bug_id')->references('id')->on('cp_bugs_tickets');
            $table->foreign('account_id')->references('id')->on('accounts');

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
        Schema::dropIfExists('cp_bugs_comments');
    }
}
