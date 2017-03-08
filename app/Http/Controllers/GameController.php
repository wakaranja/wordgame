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
        $games = Game::orderBy('created_at','desc')->paginate(10);
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

    public function newround(Request $request,$id)
    {
        //
        $oldgame = Game::find($id);
        $game = new Game;
        $game->letter=Str::upper(chr(rand(65,90)));
        $request->user()->games()->save($game);

        foreach($oldgame->categories as $oldcategory)
        {
          $oldcat = Category::find($oldcategory->id);
          $gamecat = Game::find($game->id);
          $gamecat->categories()->attach($oldcat);
        }


        $game->update();

        return redirect()->route('playgame',['game_id'=>$game->id]);

    }

    public function playagain(Request $request,$id)
    {
        //
        $oldgame = Game::find($id);

        $game = Game::where('user_id',$oldgame->user_id)->orderBy('created_at','desc')->first();
        $game->players()->attach(Auth::user());

        return redirect()->route('playgame',['game_id'=>$game->id]);

    }

    public function janjanewround(Request $request,$id)
    {
        //
        $oldgame = Game::find($id);
        $game = new Game;
        $game->letter=Str::upper(chr(rand(65,90)));
        $request->user()->games()->save($game);

        foreach($oldgame->categories as $oldcategory)
        {
          $oldcat = Category::find($oldcategory->id);
          $gamecat = Game::find($game->id);
          $gamecat->categories()->attach($oldcat);
        }


        $game->update();

        return redirect()->route('janjaplaygame',['game_id'=>$game->id]);

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

    public function janjashow($id)
    {
        //
        $game = Game::find($id);

        $categories = Category::orderBy('name','asc')->paginate(50);

        return view('games.janjasetup',['game'=>$game,'categories'=>$categories]);
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

      // return redirect()->route('gamesetup',['gameid'=>$game_id]);
      return back();
    }

    public function deletegamecategory($game_id,$category_id)
    {
      $game=Game::find($game_id);
      $category=Category::find($category_id);
      $game->categories()->detach($category);

      // return redirect()->route('gamesetup',['gameid'=>$game_id]);
      return back();
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

    public function janjaplaygame($game_id)
    {
      $game = Game::find($game_id);
      $playedthisgamepreviously = Game::where('id',$game_id)->count();
      if($playedthisgamepreviously > 0){
        $game->players()->detach(Auth::user());
      }

      $game = Game::find($game_id);
      $janja = User::find(3);
      $game->players()->attach(Auth::user());
      $game->players()->attach($janja);


      return view('games.janjaplay',['game'=>$game]);
    }

    public function leavegame($game_id)
    {
      $game = Game::find($game_id);
      $game->players()->detach(Auth::user());

      return redirect()->route('games');
    }

    public function janjaleavegame($game_id)
    {
      $game = Game::find($game_id);
      $janja = User::find(3);
      $game->players()->detach(Auth::user());
      $game->players()->detach($janja);
      $game->delete();

      return view('home');
    }


    public function janja(Request $request)
    {
      $game = new Game;
      $game->letter=Str::upper(chr(rand(65,90)));

      $request->user()->games()->save($game);

      return redirect()->route('janjagamesetup',['gameid'=>$game->id]);
    }


}
