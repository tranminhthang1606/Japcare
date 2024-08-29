<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddFieldSettingTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('settings', function (Blueprint $table) {
            $table->text('product_service')->nullable()->after('url_website');
            $table->string('purchase_guide_banner', 255)->nullable()->after('product_service');
            $table->text('bank_transfer_guide')->nullable()->after('purchase_guide_banner');
            $table->text('ship_block')->nullable()->after('bank_transfer_guide');
            $table->text('footer_service')->nullable()->after('ship_block');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('settings', function (Blueprint $table) {
            //
        });
    }
}
