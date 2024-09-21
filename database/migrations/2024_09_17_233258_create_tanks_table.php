<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTanksTable extends Migration
{
    public function up()
    {
        Schema::create('tanks', function (Blueprint $table) {
            $table->id();
            $table->string('location');
            $table->decimal('capacity', 10, 2);
            $table->string('unit')->default('liters');
            $table->unsignedBigInteger('client_id')->nullable();
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('tanks');
    }
}

