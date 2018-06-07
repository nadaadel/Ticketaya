@extends('admin.index')
@section('content')

<h2>All Tickets Locations</h2>

<div class="text-center">
<div style="width: 1200px; height: 500px;">
        {!! Mapper::render() !!}
</div>
</div>
@endsection
