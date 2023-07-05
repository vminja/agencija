<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddGodinaToKnjigeTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('knjige', function (Blueprint $table) {
            $table->string('godinaRodjenja', 20)->nullable()->after('prezimeAutora');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('knjige', function (Blueprint $table) {
            //
        });
    }
}
