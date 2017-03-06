@extends('layouts.app')
@section('content')

<div class="col-md-12">
  <div class="panel panel-default">
    <div class="panel-heading">Game Results: Letter played: <b>{{$results->letter}}</b></div>
      <div class="panel-body">

          <div class="table-responsive">
          <table class="table table-hover">
            <thead>
              <tr>
                <th>Players</th>
                @foreach ($results->categories as $category)
                  <th>{{$category->name}}</th>
                @endforeach
                <th>Score</th>
              </tr>
            </thead>
            <tbody>
                @foreach ($results->players as $player)
                <tr>
                <td>  {{$player->name}}</td>
                  <?php $totalscore=0 ?>
                  @foreach($player->gameresults as $gameresult)
                  @if($gameresult->game_id == $results->id)
                  <td>
                  {{$gameresult->entry}}
                  <sup><span class="badge badge-score">{{$gameresult->score}}</span></sup>
                </td>
                <?php $totalscore+=$gameresult->score ?>
                @endif
                @endforeach
                  <td><span class="badge badge-total">{{$totalscore}}</span></td>
                  </tr>
                  @endforeach
            </tbody>
          </table>
        </div>
      </div>
      <br>
      @if( $results->user_id == Auth::user()->id )
      <div class="text-centre">
        <a href="{{ route('newround',['id'=>$results->id]) }}"><button type="button" class="btn btn-primary"name="button">New Game</button></a>
      </div>
      @else
      <div class="text-centre">
        <a href="#"><button type="button" class="btn btn-primary"name="button">Play Again</button></a>
      </div>
      @endif
      <br>
  </div>
</div>

@endsection
