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

            $table->string('order_number');
            $table->foreignId('user_id')->constrained()->onDelete('cascade');
            $table->float('grand_total');
            $table->integer('item_count');
            $table->boolean('completed')->default(FALSE);
            $table->enum('payment_method', ['cash_on_delivery', 'paypal','card'])->default('cash_on_delivery');
            $table->enum('status', ['pending', 'failed','paid', 'delivered'])->default('pending');

            $table->string('shipping_first_name');
            $table->string('shipping_last_name');
            $table->string('shipping_address');
            $table->string('shipping_city');
            $table->string('shipping_state');
            $table->string('shipping_phone');
            $table->string('shipping_notes')->nullable();

            $table->string('billing_first_name');
            $table->string('billing_last_name');
            $table->string('billing_address');
            $table->string('billing_city');
            $table->string('billing_state');
            $table->string('billing_phone');

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
