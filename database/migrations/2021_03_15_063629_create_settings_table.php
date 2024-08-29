<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSettingsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('settings', function (Blueprint $table) {
            $table->id();
            $table->string('st_name_site');
            $table->string('st_logo');
            $table->string('admin_logo', 255)->nullable();
            $table->string('favicon', 255)->nullable();
            $table->string('admin_login_sidebar', 255)->nullable();
            $table->string('phone', 15)->nullable();
            $table->string('hotline', 15)->nullable();
            $table->string('email',100)->nullable();
            $table->string('facebook', 200)->nullable();
            $table->string('youtube',255)->nullable();
            $table->string('instagram', 255)->nullable();
            $table->string('customer_service', 500)->nullable();
            $table->string('st_txt_footer', 500)->nullable();
            $table->string('copyright', 255)->nullable();
            $table->text('address')->nullable();
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
        Schema::dropIfExists('settings');
    }
}
