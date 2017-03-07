@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-heading">Welcome</div>

                <div class="panel-body">
                    <div class="col-md-12">
                      <a href="{{ route('games') }}"><h3><i class="fa fa-users" aria-hidden="true"></i>   Play vs other players</h3></a>
                      <hr>
                    </div>

                    <div class="col-md-12">
                      <a href="{{ route('janja') }}"><h3><i class="fa fa-android" aria-hidden="true"></i>   Play vs Janja (Our Words Bot)</h3></a>
                      <hr>
                    </div>

                    <div class="col-md-12">
                      <a href="{{ route('newgame') }}"><h3><i class="fa fa-plus-circle" aria-hidden="true"></i>   Create a new game</h3></a>
                      <hr>
                    </div>

                    <div class="col-md-12">
                      <a href="{{ route('categories') }}"><h3><i class="fa fa-file-text" aria-hidden="true"></i>   Add a new category</h3></a>
                      <hr>
                    </div>


                </div>
            </div>
        </div>
    </div>
</div>
@endsection
