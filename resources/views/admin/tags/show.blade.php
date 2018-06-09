@extends('admin.index')
@section('content')
<h3>Tag Info</h3>
<label>Name</label> : {{$tag->name}}
<br/>
<span ><a href="/tags/{{$tag->id}}/tickets">Show related tickets</a></span>
@endsection
