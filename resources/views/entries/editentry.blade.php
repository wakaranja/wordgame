@extends('layouts.app')
@section('content')
  <div class="container">
    <div class="col-md-10 col-md-offset-1">


      <div class="panel panel-default">
        <div class="panel-heading">Edit Entry</div>
        <div class="panel-body">
          <form class="form-horizontal" action="{{ route('updateentry',['id'=>$entry->id]) }}" method="post">
            {{ csrf_field() }}
            <div class="form-group{{ $errors->has('name') ? ' has-error' : '' }}">
                <label for="name" class="col-md-4 control-label">Entry Name</label>
                  <div class="col-md-6">
                    <input id="entry_name" type="text" class="form-control" name="name" value="{{ $entry->name }}" autofocus>
                        @if ($errors->has('name'))
                            <span class="help-block">
                                <strong>{{ $errors->first('name') }}</strong>
                            </span>
                        @endif
                    </div>
            </div>

            <div class="form-group">
              <div class="col-md-6 col-md-offset-4">
                <button type="submit" class="btn btn-primary">
                  Update Entry
                </button>
              </div>
            </div>

          </form>
          <hr>

        </div>
      </div>




    </div>

  </div>
@endsection
