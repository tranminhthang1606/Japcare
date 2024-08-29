<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProductColorsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('product_colors', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('product_id');
            $table->unsignedBigInteger('product_size_id');
            $table->unsignedBigInteger('color_id');
            $table->string('photo_color', 2000)->nullable()->comment('Anh san pham theo mau sac');
            $table->string('code', 20)->nullable();
            $table->integer('stock')->default(0);
            $table->decimal('price',12,4)->nullable();
            $table->decimal('sale_price',12,4)->nullable();
            $table->decimal('discount',10,4)->nullable();
            $table->boolean('is_default')->default(0)->comment('Moi size co 1 mau mac dinh');
            $table->boolean('is_show')->default(0);
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
        Schema::dropIfExists('product_colors');
    }
}
