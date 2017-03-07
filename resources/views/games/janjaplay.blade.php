@extends('layouts.app')
@section('content')

<div class="container">

        <div class="col-md-12">
            <div class="panel panel-default">

                <div class="panel-heading">Game On! You are playing with Letter {{$game->letter}}</div>

                <div class="panel-body">
                  <form class="form-horizontal" role="form" method="POST" action="{{ route('janjagamescore')}}">
                    {{ csrf_field() }}
                  @foreach($game->categories as $category)
                  <div class="col-md-2">
                    <label for="{{$category->name}}" class="control-label">{{str_singular($category->name)}}</label>
                    <input type="text" class="form-control" name="{{$category->name}}" value="" placeholder="{{$game->letter}}" >
                  </div>
                  @endforeach
                  <input type="hidden" name="game_id" value="{{$game->id}}">

                    <div class="col-md-12 text-centre">
                      <br>
                        <button type="submit" class="btn btn-primary">
                            Done, Submit my entries!
                        </button><br><br>



                    </div>

                    </form>
                    <div class="col-md-12 text-centre">
                      <a href="{{ route('janjaleavegame',['game_id'=>$game->id]) }}"><button class="btn btn-danger"  onclick="return confirm('Are you sure you want to leave this game?');">
                          Cancel & Leave Game.
                      </button></a>
                    </div>


                </div>

            </div>
        </div>

</div>


@endsection
