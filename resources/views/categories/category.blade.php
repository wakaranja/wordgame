@extends('layouts.app')
@section('content')
  <div class="container">
    <div class="col-md-10 col-md-offset-1">
      <h2>{{$category->name}} Category</h2><hr>

      <div class="panel panel-default">
        <div class="panel-heading">Add Entry</div>
        <div class="panel-body">
          <form class="form-horizontal" action="{{ route('addentry') }}" method="post">
            {{ csrf_field() }}
            <input type="hidden" class="form-control" name="category_id" value="{{ $category->id }}">
            <div class="form-group{{ $errors->has('name') ? ' has-error' : '' }}">
                <label for="name" class="col-md-4 control-label">Entry Name</label>
                  <div class="col-md-6">
                    <input id="entry_name" type="text" class="form-control" name="name" value="{{ old('name') }}" autofocus>
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
                  Add Entry
                </button>
              </div>
            </div>

          </form>
          <hr>
          @foreach($category->entries as $entry)
            {{ $entry->name }}
            @if( $entry->user_id == Auth::user()->id )
            <a href="{{ route('editcategory',['id'=>$category->id]) }}"><small>edit</small></a> |
            <a href="{{ route('deletecategory',['id'=>$category->id]) }}"><small>delete</small></a>
            @endif
            -
          @endforeach
        </div>
      </div>




    </div>

  </div>
@endsection
