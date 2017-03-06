<?php

namespace App\Http\Controllers;

use App\Gamescore;
use Illuminate\Http\Request;
use App\User;
use App\Game;
use App\Entry;
use Auth;

class GamescoreController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
        $user_id=Auth::user()->id;

        $game_id=$request['game_id'];

        $oldentrycount=Gamescore::where('game_id',$game_id)->where('user_id',$user_id)->count();

        if($oldentrycount>0){
          $oldentry=Gamescore::where('game_id',$game_id)->where('user_id',$user_id)->delete();
        }



        $game = Game::find($request['game_id']);

        foreach ($game->categories as $category) {
          $gamescore=new Gamescore;

          $category_name = str_replace(' ','_', $category->name);

          $gamescore->user_id = Auth::user()->id;
          $gamescore->game_id = $request['game_id'];
          $gamescore->category_id = $category->id;
          $gamescore->entry = $request[$category_name];
          $gamescore->score = 0;

          $gamescore->save();
        }

        $mygame = Game::find($request['game_id']);

        return redirect()->route('waiting',['id'=>$mygame->id]);

    }

    public function waiting($id)
    {
      $mygame = Game::find($id);

      return view('games.waiting',['mygame'=>$mygame]);
    }

    public function loadresults($game_id)
    {
      $game = Game::find($game_id);
      $user_id = Auth::user()->id;
      foreach ($game->categories as $category) {
          $category_name = str_replace(' ','_', $category->name);
          $gamescore=Gamescore::where('game_id',$game_id)->where('user_id',$user_id)->where('category_id',$category->id)->first();
          $entry=$gamescore->entry;
          $letter=$game->letter;
          $start=starts_with($entry,$letter);
          $present=Entry::where('name',$entry)->first();
          $unique = Gamescore::where('entry',$entry)->where('game_id',$game_id)->get();
          if(($present===null) || !($start))
          {
            $score=0;
          }
          elseif($unique->count()>1){
            $score=5;
          }
          else{
            $score=10;
          }
          $gamescore->score=$score;
          $gamescore->update();
          $results=Game::find($game_id);
          $resultsinfo=Gamescore::where('game_id',$game_id)->get();
          // $game_played=Game::find($game_id);
        }
          return view('games.results',['results'=>$results,'resultsinfo'=>$resultsinfo]);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Gamescore  $gamescore
     * @return \Illuminate\Http\Response
     */
    public function show(Gamescore $gamescore)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Gamescore  $gamescore
     * @return \Illuminate\Http\Response
     */
    public function edit(Gamescore $gamescore)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Gamescore  $gamescore
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Gamescore $gamescore)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Gamescore  $gamescore
     * @return \Illuminate\Http\Response
     */
    public function destroy(Gamescore $gamescore)
    {
        //
    }
}
