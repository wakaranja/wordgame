@extends('layouts.app')
@section('content')

<div class="container">
  <div class="panel pane-default">
    <div class="panel-heading">Analysing...</div>
      <div class="panel-body">
        Your entries were submitted successfully...<br>
        Collecting data from other players...<br>
        Analysing data...<br>
        Calculating scores...<br>

      </div>

      <a href="{{ route('loadresults',['game_id'=>$mygame->id]) }}"><button type="button" class="btn btn-primary" name="button">Load Results</button></a>

  </div>
</div>


@endsection
