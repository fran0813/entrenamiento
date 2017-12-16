<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Qualification extends Model
{
    protected $table = "qualifications";

    protected $fillable = [
    	'note', 'user_id', 'category_id',
	];

	public function category()
    {
        return $this->belongsTo('App\Category');
    }
}
