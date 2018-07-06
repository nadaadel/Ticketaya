@extends('admin.index')
@section('content')
<form method="POST" action="/categories/{{$category->id}}" enctype="multipart/form-data">
    @csrf
    {{method_field('PUT')}}
    <label>Category Name</label> <br>
    <input  type="text" name="name" value="{{$category->name}}">

    <div class="row">
            <div class="col-md-6">
             <label for="image">Category Image</label>
               <img src="{{ asset('storage/images/categories/'. $category->photo) }}" style="height:150px;"/>
            <input type="file" class="form-control-file ml-3 mt-2" name="photo" value="{{$category->photo}}"/>
               @if ($errors->has('photo'))
                <span class="alert alert-danger">
                <strong>{{ $errors->first('photo') }}</strong>
                </span>
              @endif
            </div>
        </div>
    <input type="submit" class="btn btn-success" value="Update">
</form>
@endsection
