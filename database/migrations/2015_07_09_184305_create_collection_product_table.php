<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateCollectionProductTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('collection_product', function (Blueprint $table) {
            $table->integer('collection_id')->unsigned()->index();
            $table->integer('product_id')->unsigned()->index();
            $table->timestamps();

            $table->foreign('collection_id')->references('id')->on('collections')->onDelete('cascade');
            $table->foreign('product_id')->references('id')->on('products')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        /* DB::statement('SET FOREIGN_KEY_CHECKS = 0'); */
        Schema::drop('collection_product');
        /* DB::statement('SET FOREIGN_KEY_CHECKS = 1'); */
    }
}
