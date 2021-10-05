<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateClientsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('clients', function (Blueprint $table) {
            $table-> id();
            $table->string('ClientName');
            $table->string('ClientAddress');
            $table->string('Website')->nullable();
            $table->string('Representative_FirstName');
            $table->string('Representative_LastName');
            $table->string('Representative_email')->unique()->nullable();
            $table->boolean('is_active')->default(false);
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
        Schema::dropIfExists('clients');
    }
}
