@extends('layouts.app')
@section('content')
  <div class="container">
    <div class="col-md-12">
      <h2>Categories</h2><hr>

      <div class="col-md-8">
        <div class="panel panel-default">
          <div class="panel-heading">Categories</div>
            <div class="panel-body">

              @foreach($categories as $category)
                {{$loop->index+1}}. <a href="{{ route('showcategory',['id'=>$category->id]) }}">{{ $category->name }}</a>
                @if( $category->user_id == Auth::user()->id )
                <a href="{{ route('editcategory',['id'=>$category->id]) }}"><small>edit</small></a> |
                <a href="{{ route('deletecategory',['id'=>$category->id]) }}" onclick="return confirm('Are you sure you want to delete this category?');"><small>delete</small></a>
                @endif<br>
                <i><small>{{ $category->description }}</small></i><br>
                @foreach($category->entries as $entry)
                  {{$loop->index+1 }}. {{$entry->name}}<br>
                @endforeach
                <br>
              @endforeach

              <div class="col-md-12">
                {{ $categories->links() }}
              </div>
            </div>
        </div>
      </div>

      <div class="col-md-4">
        <div class="panel panel-default">
          <div class="panel-heading">Add Category</div>
          <div class="panel-body">
            <form class="form-horizontal" action="{{ route('addcategory') }}" method="post">
              {{ csrf_field() }}
              <div class="form-group{{ $errors->has('name') ? ' has-error' : '' }}">
                  <label for="name" class="col-md-4 control-label">Category Name</label>
                    <div class="col-md-8">
                      <input id="category_name" type="text" class="form-control" name="name" value="{{ old('name') }}" autofocus required>
                          @if ($errors->has('name'))
                              <span class="help-block">
                                  <strong>{{ $errors->first('name') }}</strong>
                              </span>
                          @endif
                      </div>
              </div>

              <div class="form-group{{ $errors->has('description') ? ' has-error' : '' }}">
                  <label for="description" class="col-md-4 control-label">Category Description</label>
                    <div class="col-md-8">

                      <textarea name="description" rows="5" class="form-control" placeholder="A brief description of this category"></textarea>

                          @if ($errors->has('description'))
                              <span class="help-block">
                                  <strong>{{ $errors->first('description') }}</strong>
                              </span>
                          @endif
                      </div>
              </div>

              <div class="form-group">
                <div class="col-md-6 col-md-offset-4">
                  <div class="checkbox">
                    <label>
                      <input type="checkbox" name="private"> Private Category?
                    </label>
                  </div>
                </div>
              </div>

              <div class="form-group">
                <div class="col-md-6 col-md-offset-4">
                  <button type="submit" class="btn btn-primary">
                    Create Category
                  </button>
                </div>
              </div>

            </form>

          </div>
        </div>

      </div>





    </div>

  </div>
@endsection
