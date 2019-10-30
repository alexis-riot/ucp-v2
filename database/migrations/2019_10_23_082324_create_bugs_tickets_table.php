<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateBugsTicketsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('cp_bugs_tickets', function (Blueprint $table) {
            $table->bigIncrements('id');

            $table->integer('type');
            $table->unsignedInteger('account_id');

            $table->string('subject');
            $table->integer('priority');
            $table->integer('status')->default(0);

            $table->integer('tester_assigned')->default(-1);
            $table->integer('developer_assigned')->default(-1);

            $table->timestamps();

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
        Schema::dropIfExists('cp_bugs_tickets');
    }
}
