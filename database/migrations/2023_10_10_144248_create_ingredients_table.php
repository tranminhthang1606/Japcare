<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateIngredientsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('ingredients', function (Blueprint $table) {
            $table->id();
            $table->string('title', 255);
            $table->text('description')->nullable();
            $table->boolean('status')->default(1);
            $table->bigInteger('created_by');
            $table->softDeletes();
            $table->timestamps();
        });

        Schema::create('product_uses', function (Blueprint $table) {
            $table->id();
            $table->string('title', 255);
            $table->string('icon_uses', 255)->nullable();
            $table->text('description')->nullable()->comment('id ingredient json');
            $table->boolean('status')->default(1);
            $table->bigInteger('created_by');
            $table->softDeletes();
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
        Schema::dropIfExists('ingredients');
        Schema::dropIfExists('product_uses');
    }
}
