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
        Schema::create('bugs_tickets', function (Blueprint $table) {
            $table->bigIncrements('id');

            $table->integer('type');
            $table->integer('account_id');

            $table->string('subject');
            $table->integer('priority');
            $table->integer('status')->default(0);

            $table->integer('tester_assigned')->default(-1);
            $table->integer('developer_assigned')->default(-1);

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
        Schema::dropIfExists('bugs_tickets');
    }
}
