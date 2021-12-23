<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateRandomnessTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('randomness', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained();
            $table->string('company');
            $table->string('phone_number');
            $table->string('description')->nullable();
            $table->string('type');
            $table->string('iban', 34);
            $table->string('pan');
            $table->integer('cvv');
            $table->string('expiration');
            $table->string('hex_color');
            $table->string('country', 100)->nullable();
            $table->float('latitude');
            $table->float('longitude');
            $table->date('birthday');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('randomness');
    }
}
