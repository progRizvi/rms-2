<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('orders', function (Blueprint $table) {
            $table->id();
            $table->integer("customer_id");
            $table->string("name")->nullable();
            $table->integer("restaurant_id")->nullable();
            $table->integer("total_price")->nullable();
            $table->integer("total_quantity")->nullable();
            $table->string("phone")->nullable();
            $table->string("transaction_id")->nullable();
            $table->string("payment_status")->nullable();
            $table->string("order_status")->nullable();
            $table->string("payment_status")->nullable();
            $table->string("currency")->nullable();
            $table->string("delivery_address")->nullable();
            $table->string("delivery_charge")->nullable();
            $table->string("order_note")->nullable();
            $table->string("order_date")->nullable();
            $table->string("order_time")->nullable();

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
        Schema::dropIfExists('orders');
    }
};
