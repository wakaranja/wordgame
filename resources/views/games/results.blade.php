@extends('layouts.app')
@section('content')

<div class="col-md-12">
  <div class="panel panel-default">
    <div class="panel-heading">Game Results: Letter played: {{$results->letter}}</div>
      <div class="panel-body">

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
                  {{$gameresult->score}}
                </td>
                <?php $totalscore+=$gameresult->score ?>
                @endif
                @endforeach
                  <td>{{$totalscore}}</td>
                  </tr>
                  @endforeach
            </tbody>
          </table>
      </div>
  </div>
</div>

@endsection
