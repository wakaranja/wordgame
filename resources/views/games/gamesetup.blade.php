@extends('layouts.app')
@section('content')
  <div class="container">
    <div class="col-md-12">
      <h2>Game Setup</h2><hr>

      <div class="col-md-6">
        <div class="panel panel-default">
          <div class="panel-heading">Game code #{{ $game->id }} categories @if( count($game->categories)>0)<a href="{{ route('playgame',['game_id'=>$game->id]) }}"><b class="pull-right"> <i class="fa fa-play" aria-hidden="true"></i>  Play this game @endif</b></a></div>
            <div class="panel-body">

              @foreach($game->categories as $category)
                {{$loop->index+1 }}. {{$category->name}} {{$category->id}}
                <a href="{{ route('deletegamecategory',['game_id'=>$game->id,'category_id'=>$category->id]) }}" onclick="return confirm('Are you sure you want to delete this category?');"><small>delete</small></a>
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
                   <a href="{{ route('addgamecategory',['game_id'=>$game->id,'category_id'=>$category->id]) }}"><small>Add to the game</small></a>
               <br>

                @endforeach

              </div>

              </div>
          </div>
      </div>

    </div>

  </div>
@endsection
