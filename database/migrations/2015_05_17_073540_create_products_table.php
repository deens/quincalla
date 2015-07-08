<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateProductsTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('products', function(Blueprint $table)
		{
			$table->increments('id');
            $table->integer('collection_id')->unsigned();
            $table->string('name');
            $table->string('slug')->unique();
            $table->text('description');
            $table->string('picture');
            $table->float('price');
            $table->float('compare_price');
            $table->string('vendor')->nullable();
            $table->string('type')->nullable();
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
		Schema::drop('products');
	}

}
