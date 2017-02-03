<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUsersCategoriesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('users_categories', function (Blueprint $table) {
            $table->integer('categories_id')->unsigned();
            $table->integer('users_id')->unsigned();
			
			#Foreign key
            $table->foreign('categories_id')->references('id')->on('categories');
            $table->foreign('users_id')->references('id')->on('users');
            
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('users_categories', function (Blueprint $table) {
            //
        });
    }
}
