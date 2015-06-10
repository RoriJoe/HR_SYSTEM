<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateWorkleavesTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('workleaves', function(Blueprint $table)
		{
			$table->increments('id');
			$table->integer('organisation_id')->unsigned()->index();
			$table->string('name', 255);
			$table->integer('quota');
			$table->timestamps();
			$table->softDeletes();
			
			$table->index(['deleted_at', 'organisation_id']);
		});
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('workleaves');
	}

}
