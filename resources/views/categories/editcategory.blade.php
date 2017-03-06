@extends('layouts.app')
@section('content')
  <div class="container">
    <div class="col-md-10 col-md-offset-1">


      <div class="panel panel-default">
        <div class="panel-heading">Edit Category</div>
        <div class="panel-body">
          <form class="form-horizontal" action="{{ route('updatecategory',['id'=>$category->id]) }}" method="post">
            {{ csrf_field() }}
            <div class="form-group{{ $errors->has('name') ? ' has-error' : '' }}">
                <label for="name" class="col-md-4 control-label">Category Name</label>
                  <div class="col-md-6">
                    <input id="category_name" type="text" class="form-control" name="name" value="{{ $category->name }}" autofocus>
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

                    <textarea name="description" rows="5" class="form-control" placeholder="A brief description of this category">{{ $category->name }}</textarea>

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
                    @if($category->private == 1)
                      <input type="checkbox" name="private" checked> Private Category?
                    @else
                      <input type="checkbox" name="private"> Private Category?
                    @endif
                  </label>
                </div>
              </div>
            </div>

            <div class="form-group">
              <div class="col-md-6 col-md-offset-4">
                <button type="submit" class="btn btn-primary">
                  Update Category
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
