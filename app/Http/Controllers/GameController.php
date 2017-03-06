<?php

namespace App\Http\Controllers;
use Illuminate\Support\Str;

use Illuminate\Http\Request;
use App\Game;
use App\Category;
use App\User;
use Auth;

class GameController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $games = Game::orderBy('created_at','desc')->paginate(50);
        return view('games.games',['games'=>$games]);
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
        $game = new Game;
        $game->letter=Str::upper(chr(rand(65,90)));

        $request->user()->games()->save($game);

        return redirect()->route('gamesetup',['gameid'=>$game->id]);

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
        $game = Game::find($id);

        $categories = Category::orderBy('name','asc')->paginate(50);

        return view('games.gamesetup',['game'=>$game,'categories'=>$categories]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
        $game = Game::find($id)->delete();
        return back();
    }

    public function addgamecategory($game_id,$category_id)
    {
      $game=Game::find($game_id);
      $category=Category::find($category_id);

      $game->categories()->attach($category);

      return redirect()->route('gamesetup',['gameid'=>$game_id]);
    }

    public function deletegamecategory($game_id,$category_id)
    {
      $game=Game::find($game_id);
      $category=Category::find($category_id);
      $game->categories()->detach($category);

      return redirect()->route('gamesetup',['gameid'=>$game_id]);
    }

    public function playgame($game_id)
    {
      $game = Game::find($game_id);
      $playedthisgamepreviously = Game::where('id',$game_id)->count();
      if($playedthisgamepreviously > 0){
        $game->players()->detach(Auth::user());
      }

      $game = Game::find($game_id);
      $game->players()->attach(Auth::user());

      return view('games.play',['game'=>$game]);
    }

}
