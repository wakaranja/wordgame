@extends('layouts.app')
@section('content')
  <div class="container">
    <div class="col-md-12">
      <h2>Janja Game Setup</h2><hr>
      <div class="col-md-12">
        <div class="col-md-1">
          <img src="{{ asset('img/bot.png') }}" alt="Word Bot" class="img-responsive" width=200 height=200>
        </div>
         Hey my good friend {{Auth::user()->name}}! My name is <b>Janja!</b> You have decided to challenge me to a word game. I sleep, eat and live words. Let us see how good you will fair. You will mostly lose this one. Prove me wrong!
         Choose the categories you want to play below.
      </div>
      <div class="col-md-6">
        <div class="panel panel-default">
          <div class="panel-heading">Game code <span class="badge">{{ $game->id }}</span> categories @if( count($game->categories)>0)<a href="{{ route('janjaplaygame',['game_id'=>$game->id]) }}"><b class="pull-right"> <i class="fa fa-play" aria-hidden="true"></i>  Play this game @endif</b></a></div>
            <div class="panel-body">

              @foreach($game->categories as $category)
                {{$loop->index+1 }}. {{$category->name}}
                <a href="{{ route('deletegamecategory',['game_id'=>$game->id,'category_id'=>$category->id]) }}" onclick="return confirm('Are you sure you want to delete this category?');"> <small><span class="label label-danger"> Remove</span></small></a>
                <br>
              @endforeach

            </div>

            </div>
        </div>

        <div class="col-md-6">
          <div class="panel panel-default">
            <div class="panel-heading">Categories</div>
              <div class="panel-body">

                @foreach($categories as $category)
                    {{$loop->index+1 }}. {{$category->name}}
                   <a href="{{ route('addgamecategory',['game_id'=>$game->id,'category_id'=>$category->id]) }}"><span class="label label-success">Add to the game</span></a>
               <br>

                @endforeach

              </div>

              </div>
          </div>
      </div>

    </div>

  </div>
@endsection
