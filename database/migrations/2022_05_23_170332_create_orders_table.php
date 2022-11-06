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
            $table->bigInteger('user_id');
            $table->bigInteger('admin_id');
            $table->string('order_code');
            $table->string('name');
            $table->string('email');
            $table->string('phone');
            $table->string('address');
            $table->string('province');
            $table->string('district');
            $table->string('ward');
            $table->text('notes')->nullable();
            $table->double('fee_charge');
            $table->string('coupon_code')->nullable();
            $table->double('sum_price');
            $table->string('payment_type');
            $table->string('cancel_date')->nullable();
            $table->string('reason_cancel')->nullable();
            $table->tinyInteger('payment_status')->default(0);
            $table->tinyInteger('status')->default(0);
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
