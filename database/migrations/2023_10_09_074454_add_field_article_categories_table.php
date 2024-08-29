<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddFieldArticleCategoriesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('article_categories', function (Blueprint $table) {
            //
            $table->string('slug',255)->unique()->index()->change();
            $table->dropColumn('is_show_menu');
            $table->tinyInteger('is_show')->index()->after('status')->default(1)->comment('1 hien thi trang danh sach, 2 khong hien thi');
            $table->unsignedBigInteger('parent_id')->index()->change();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('article_categories', function (Blueprint $table) {
            //
        });
    }
}
