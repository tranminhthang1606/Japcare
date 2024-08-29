<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDeliveryFeesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('delivery_fees', function (Blueprint $table) {
            $table->id();
            $table->string('matp', 5)->comment('Ma tinh');
            $table->decimal('fee',12,4)->nullable()->comment('Phi van chuyen');
            $table->integer('admin_change')->nullable()->comment('Nguoi thay doi');
            $table->dateTime('time_change')->nullable()->comment('Thoi gian thay doi');
            $table->string('status', 10)->default('NOW')->comment('NOW: fee hien tai, OLD: fee cu');
            $table->integer('admin_id')->comment('Nguoi tao');
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
        Schema::dropIfExists('delivery_fees');
    }
}
