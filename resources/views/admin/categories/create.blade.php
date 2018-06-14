@extends('admin.index')
@section('content')
<form method="POST" action="/categories" enctype="multipart/form-data">
    @csrf
    <label>Category Name</label> <br>
    <input  type="text" name="name">
    <div class="row">
            <div class="col-md-12">
                <label for="image">Category Image</label>
                <input type="file" class="form-control-file ml-3 mt-2" name="photo"/>
            </div>
        </div>
    <input type="submit" class="btn btn-success" value="Create">
</form>
@endsection
