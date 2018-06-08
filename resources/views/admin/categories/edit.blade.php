@extends('admin.index')
@section('content')
<form method="POST" action="/admin/categories/{{$category->id}}">
    @csrf
    {{method_field('PUT')}}
    <label>Category Name</label> <br>
    <input  type="text" name="name" value="{{$category->name}}">
    <input type="submit" class="btn btn-success" value="Update">
</form>
@endsection
