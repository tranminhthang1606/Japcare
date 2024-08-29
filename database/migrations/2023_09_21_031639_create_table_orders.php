<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTableOrders extends Migration
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
            $table->bigInteger('customer_id')->nullable()->unsigned();
            $table->foreign('customer_id')->references('id')->on('customers');
            $table->string('customer_name', 255)->nullable();
            $table->string('customer_phone', 15)->nullable();
            $table->string('shipping_address', 500)->nullable();
            $table->tinyInteger('payment_method')->default(1)->comment('1 cod, 2 bacs');
            $table->tinyInteger('delivery_status')->default(1)->comment('1 xac nhan don, 2 dang xu ly, 3 dang giao, 5 hoan thanh, 4 huy don');
            $table->tinyInteger('payment_status')->default(1)->comment('1 chua thanh toan, 2 da thanh toan, 3 huy, 4 hoan tien');
            $table->tinyInteger('status')->default(1)->comment('1 moi, 2 hoan thanh, 3 huy');
            $table->text('order_note')->nullable();
            $table->decimal('grand_total',14,2)->nullable()->comment('tong tien');
            $table->decimal('delivery_fee',12,2)->nullable()->comment('phi giao hang');
            $table->decimal('coupon_discount',12,2)->nullable()->comment('tien coupon');
            $table->string('code', 191)->comment('ma don hang');
            $table->integer('order_at')->comment('thoi gian dat');
            $table->tinyInteger('viewed')->default(0)->comment('luot xem');

            $table->softDeletes('deleted_at')->nullable();
            $table->timestamp('created_at')->useCurrent();
            $table->timestamp('updated_at')->nullable()->useCurrentOnUpdate();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('table_orders');
    }
}
