@extends('layouts.app')
@section('content')

<div class="container">

        <div class="col-md-12">
            <div class="panel panel-default">

                <div class="panel-heading">Game On! You are playing with Letter {{$game->letter}}</div>

                <div class="panel-body">
                  <form class="form-horizontal" role="form" method="POST" action="{{ route('gamescore')}}">
                    {{ csrf_field() }}
                  @foreach($game->categories as $category)
                  <div class="col-md-2">
                    <label for="{{$category->name}}" class="control-label">{{$category->name}}</label>
                    <input type="text" class="form-control" name="{{$category->name}}" value="" placeholder="{{$game->letter}}" >
                  </div>
                  @endforeach
                  <input type="hidden" name="game_id" value="{{$game->id}}">

                    <div class="col-md-6 col-md-offset-4">
                      <br>
                        <button type="submit" class="btn btn-primary">
                            Done, Submit my entries!
                        </button>
                    </div>

                    </form>
                </div>

            </div>
        </div>

</div>


@endsection
