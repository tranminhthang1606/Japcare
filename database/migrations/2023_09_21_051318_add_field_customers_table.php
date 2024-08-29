<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddFieldCustomersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('customers', function (Blueprint $table) {
            //
            $table->dropColumn('user_id');
            $table->string('full_name', 255)->after('id');
            $table->string('user_name', 191)->unique()->after('full_name');
            $table->string('phone', 15)->nullable()->after('user_name');
            $table->string('email', 191)->nullable()->after('phone');
            $table->string('sex', 10)->nullable()->comment('FEMALE | MALE | UNKNOW')->after('email');
            $table->date('birthdate')->nullable()->after('sex');
            $table->string('avatar', 255)->nullable()->after('birthdate');
            $table->string('password', 255)->after('avatar');
            $table->string('remember_token', 100)->nullable()->after('password');
            $table->tinyInteger('is_active')->default(1)->comment('1 active, 2 blog')->after('remember_token');
            $table->string('google_id', 255)->after('is_active');
            $table->string('fb_id', 255)->after('google_id');
            $table->softDeletes()->nullable()->after('fb_id');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('customers', function (Blueprint $table) {
            //
        });
    }
}
