<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    //
    public function user()
    {
      return $this->belongsTo('App\User');
    }

    public function entries()
    {
      return $this->hasMany('App\Entry');
    }

    public function categories()
    {
      return $this->belongsToMany('App\Game');
    }
}
