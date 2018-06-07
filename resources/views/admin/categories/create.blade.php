
@extends('admin.index')
@section('content')
<form method="POST" action="/admin/categories">
    @csrf
    <label>Category Name</label> <br>
    <input  type="text" name="name">
    <input type="submit" class="btn btn-success" value="Create">
</form>
@endsection
