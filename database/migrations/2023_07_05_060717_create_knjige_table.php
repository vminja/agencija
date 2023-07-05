<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateKnjigeTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('knjige', function (Blueprint $table) {
            $table->id();
            $table->string('naziv', 100);
            $table->string('imeAutora', 20);
            $table->string('prezimeAutora', 20)->nullable();
            $table->string('izdavac', 30)->nullable();
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
        Schema::dropIfExists('knjige');
    }
}
