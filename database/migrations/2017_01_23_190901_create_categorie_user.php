<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCategorieUser extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('categorie_user', function (Blueprint $table) {
			
            $table->integer('user_id')->unsigned();
            $table->integer('categorie_id')->unsigned();
			$table->timestamps();
			
			#Index
			$table->index('user_id');
			$table->index('categorie_id');
	
			#Foreign key
			$table->foreign('user_id')->references('id')->on('users');
			$table->foreign('categorie_id')->references('id')->on('categories');
			
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('categorie_user');
    }
}
