<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddColumnToDtbUsers extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('dtb_users', function (Blueprint $table) {
            $table->string('two_factor_code')->nullable();
    $table->dateTime('two_factor_expires_at')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('dtb_users', function (Blueprint $table) {
            $table->string('two_factor_code')->nullable();
    $table->dateTime('two_factor_expires_at')->nullable();
        });
    }
}
