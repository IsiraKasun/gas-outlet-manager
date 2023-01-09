<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateOrdersTable extends Migration
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
            $table->unsignedBigInteger('customer_id');
            $table->unsignedBigInteger('outlet_id');
            $table->integer('small_qty')->nullable(true);
            $table->integer('medium_qty')->nullable(true);
            $table->integer('large_qty')->nullable(true);
            $table->dateTime('order_date');
            $table->decimal('order_value', 9, 2);
            $table->boolean('is_paid')->nullable(true);
            $table->boolean('is_issued')->nullable(true);
            $table->foreign('customer_id')->references('id')->on('users')->onUpdate('cascade')->onDelete('cascade');
            $table->foreign('outlet_id')->references('id')->on('outlets')->onUpdate('cascade')->onDelete('cascade');
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
}
