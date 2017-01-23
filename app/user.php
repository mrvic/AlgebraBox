<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class user extends Model
{
    /**
	  * The tabel associated with the model.
	  *
	  * @var string
	  */
	 protected $table = 'users';
	 
	 public function kategorije()
	 {
		 return $this->hasMany(App\category);
	 }
}
