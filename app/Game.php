<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Game extends Model
{
    //
    public function user()
    {
      return $this->belongsTo('App\User');
    }

    public function categories()
    {
      return $this->belongsToMany('App\Category');
    }

    public function players()
    {
      return $this->belongsToMany('App\User','game_players');
    }

}
