<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class category extends Model
{
    /**
	  * The tabel associated with the model.
	  *
	  * @var string
	  */
	 protected $table = 'categories';
	 
	 public function kategorije()
	 {
		 return $this->belongsTo(App\user);
	 }
}
