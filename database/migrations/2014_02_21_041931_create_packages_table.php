<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePackagesTable extends Migration {

	/**
	 * Create the table for the packages.
	 * 
	 *
	 * @return void
	 */
	public function up()
	{
    Schema::create('packages', function($table) {
      $table->increments('id');
      $table->string('package_name');
      $table->decimal('package_price', 11, 0);
      $table->integer('package_time');
      $table->text('package_description');
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
    Schema::drop('packages');
	}

}
