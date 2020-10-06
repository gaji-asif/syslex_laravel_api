<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class PaymentLog extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('payment_logs', function (Blueprint $table) {
            $table->increments('id');
            $table->float('amount',8,2);
           // $table->enum('plan', ['Basic', 'Premium'])->default('Basic');
            $table->string('balance_transaction')->collation('utf8mb4_bin');
            $table->string('payment_method')->collation('utf8mb4_bin'); // for now we will store             
            $table->string('user_id')->comment('user_id');
            $table->string('card_id')->comment('card_id');
            $table->string('created')->comment('creation_time');
            $table->string('status');
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
        Schema::dropIfExists('payment_logs');

    }
}
