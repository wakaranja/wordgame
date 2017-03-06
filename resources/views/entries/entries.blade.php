@extends('layouts.app')
@section('content')
  <div class="container">
    <div class="col-md-10 col-md-offset-1">
      <h2>Entries</h2><hr>

          @foreach($entries as $entry)
            {{$loop->index+1 }}. {{ $entry->name }}<a href="{{ route('showcategory',['id'=>$entry->category->id]) }}"> ({{ $entry->category->name }})</a>
            @if( $entry->user_id == Auth::user()->id )
            <a href="{{ route('editentry',['id'=>$entry->id]) }}"><small>edit</small></a> |
            <a href="{{ route('deleteentry',['id'=>$entry->id]) }}" onclick="return confirm('Are you sure you want to delete this entry?');"><small>delete</small></a>
            @endif
            <br>
          @endforeach
          <div class="col-md-12">
            {{ $entries->links() }}
          </div>

    </div>

  </div>
@endsection
