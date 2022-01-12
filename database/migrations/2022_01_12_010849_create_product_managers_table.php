<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProductManagersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('product_managers', function (Blueprint $table) {
		$table->increments('id');
		$table->string('name');
	        $table->float('price', 8, 2);
	        $table->string('upc')->nullable();
	        $table->string('image')->nullable();
	        $table->enum('status', ['0', '1'])->default('1');
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
        Schema::dropIfExists('product_managers');
    }
}
