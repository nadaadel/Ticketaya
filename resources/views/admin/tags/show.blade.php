@extends('admin.index')
@section('content')
<h3>Tag Info</h3>
<label>Name</label>  {{$tag->name}}
<br/>
<span ><a  href="/tags/{{$tag->id}}/tickets" class="btn btn-success">Show related tickets</a></span>
@endsection
