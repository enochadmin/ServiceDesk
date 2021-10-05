<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTicketsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tickets', function (Blueprint $table) {
            $table-> id();
            $table->string('Issue');
            $table->string('Description');
            $table->string('document');
            $table->integer('Client_id');
            $table->integer('Project_id');
            $table->integer('Tag_id');
            $table->integer('Priorty');
            $table->string('date');
            $table->string('ticket_status');

            //date, priorty, tag
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('tickets');
    }
}
