<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class ChangeFieldProductsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('products', function (Blueprint $table) {
            //
            $table->string('title',255)->change();
            $table->string('slug',255)->unique()->index()->change();
            $table->unsignedBigInteger('category_id')->change();
            $table->foreign('category_id')->references('id')->on('categories');
            $table->unsignedBigInteger('brand_id')->change();
            $table->foreign('brand_id')->references('id')->on('brands');

            $table->text('description')->nullable()->change();
            $table->decimal('price',14,2)->index()->change();
            $table->decimal('sale_price',14,2)->index()->change();
            $table->float('discount', 10, 2)->nullable()->index()->change();

            $table->boolean('is_new')->default(0)->index()->change();
            $table->boolean('status')->default(0)->index()->change();
            $table->boolean('featured')->default(0)->comment('san pham ban chay')->index()->change();
            $table->boolean('is_favourite')->default(0)->index()->change();
            $table->dropColumn('is_sale');
            $table->integer('number_sold')->default(0)->comment('sp da ban')->after('discount');
            $table->text('uses')->nullable()->comment('thanh phan')->after('discount');
            $table->text('txt_uses')->nullable()->comment('thanh phan')->after('uses');
            $table->text('txt_ingredient')->nullable()->comment('thanh phan')->after('txt_uses');
            $table->text('txt_manual')->nullable()->comment('huong dan')->after('txt_ingredient');
            $table->text('txt_info')->nullable()->comment('thong tin san pham')->after('txt_manual');

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('products', function (Blueprint $table) {
            //
        });
    }
}
