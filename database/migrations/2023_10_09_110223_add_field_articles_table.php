<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddFieldArticlesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('articles', function (Blueprint $table) {
            //
            $table->unsignedBigInteger('article_category_id')->change();
            $table->foreign('article_category_id')->references('id')->on('article_categories');

            $table->text('description')->nullable()->change();
            $table->string('slug',255)->unique()->index()->change();
            $table->boolean('is_featured')->default(0)->after('status');
            $table->boolean('is_hot')->default(0)->after('is_featured');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('articles', function (Blueprint $table) {
            //
        });
    }
}
