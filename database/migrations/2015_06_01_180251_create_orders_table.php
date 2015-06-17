<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateOrdersTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('orders', function(Blueprint $table)
		{
			$table->increments('id');
            $table->string('customer_email');
            $table->string('customer_name');
            $table->float('total_amount');
            $table->string('status');
            $table->string('card_name');
            $table->string('card_type');
            $table->string('card_number');
            $table->text('shipping_address');
            $table->text('billing_address');
            $table->text('comments');
            $table->datetime('shipped_at');
            $table->datetime('completed_at');
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
		Schema::drop('orders');
	}

}
