<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    protected $table = "categories";

    protected $fillable = [
    	'name', 'user_id',
	];

	public function user()
    {
        return $this->belongsTo('App\User');
    }

    public function qualifications()
    {
        return $this->hasMany('App\Qualification');
    }
}
