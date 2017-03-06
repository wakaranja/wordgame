@extends('layouts.app')
@section('content')
  <div class="container">
    <div class="col-md-12">
      <h2>Games</h2><hr>

      <div class="col-md-10 col-md-offset-1">
        <div class="panel panel-default">
          <div class="panel-heading">Games <a href="{{ route('newgame') }}"><b class="pull-right"> <i class="fa fa-plus"></i>  New Game</b></a></div>
            <div class="panel-body">

              @foreach($games as $game)
                {{$loop->index+1 }}. Game Code #{{ $game->id }} Letter: {{ $game->letter }} --- <a href="{{ route('playgame',['game_id'=>$game->id]) }}">Play Game</a><br>
                @if( $game->user_id == Auth::user()->id )
                <a href="{{ route('gamesetup',['id'=>$game->id]) }}"><small>setup</small></a> |

                <a href="{{ route('deletegame',['id'=>$game->id]) }}" onclick="return confirm('Are you sure you want to delete this game?');"><small>delete</small></a>
                @endif<br>
                <i><small>Created by {{ $game->user->name }}</small></i><br>
                @foreach($game->categories as $category)
                  {{$loop->index+1 }}. {{$category->name}}<br>
                @endforeach
                <br>
              @endforeach

              <div class="col-md-12">
                {{ $games->links() }}
              </div>
            </div>
        </div>
      </div>

    </div>

  </div>
@endsection
