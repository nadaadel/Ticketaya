@extends('admin.index')
@section('content')
<section class="editing-forms">
    <div class="container">
        <div class="row mt-4 mb-2">
            <div class="col-md-12 text-center">
                <h2>Update Article</h2>
            </div>
        </div>
        <div class="row justify-content-md-center">
            <div class="col-md-6">
                @if (count($errors) > 0)
                <div class="alert alert-danger">
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif
            <form  method="post" action="/articles/{{$article->id}}" enctype="multipart/form-data">
             {{method_field('PUT')}}
            {{csrf_field()}}
                <div class="row">
                    <div class="col-md-12">
                       <label >Title</label>
                        <input type="text" name="title" class="form-control" placeholder="Enter Article Title" value="{{$article->title}}">
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-12">
                       <label >Select Category</label>
                        <select name="category" class="w-100">
                            @foreach($categories as $category)
                              <option value="{{ $category->id }}">{{ $category->name }}</option>
                            @endforeach
                          </select>
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-12">
                        <label >description</label>
                        <textarea name="description" class="form-control txt-area" style="height: 230px"  name="description" value={{$article->description}}>{{$article->description}}</textarea>
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-12">
                        <label for="image">Article Image</label>
                        <input type="file" class="form-control-file ml-3 mt-2" name="photo" value="{{$article->photo}}"/>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-12 text-center">
                        <input type="submit" value="Update" class="btn btn-primary pl-5 pr-5">
                    </div>
                </div>

            </form>
            </div>
        </div>
    </div>
</section>
@endsection
