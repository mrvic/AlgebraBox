<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateRootDirectoryTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('root_directory', function (Blueprint $table) {
			$table->increments('id');
+           $table->string('name');
+           $table->string('root_directory');	
+           $table->integer('users_id')->unsigned();	
            $table->increments('id');
            $table->timestamps();
			
			#Index
+			$table->index('users_id');
+			
+			# Foreign key
+			$table->foreign('users_id')->references('id')->on('users');
+			
+            $table->engine = 'InnoDB';
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('root_directory');
    }
}
