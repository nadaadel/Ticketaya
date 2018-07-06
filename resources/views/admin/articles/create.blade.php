@extends('admin.index')
@section('content')
<section class="editing-forms">
    <div class="container">
        <div class="row mt-4 mb-2">
            <div class="col-md-12 text-center">
                <h2>Create New Article</h2>
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
            <form  method="post" action="/articles/store" enctype="multipart/form-data">
            {{method_field('POST')}}
            {{csrf_field()}}
                <div class="row">
                    <div class="col-md-12">
                       <label >Title</label>
                        <input type="text" name="title" class="form-control" placeholder="Enter Article Title">
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
                        <textarea name="description" class="form-control txt-area " style="height: 230px" placeholder="Please Add Ticket Description Here ..."></textarea>
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-12">
                        <label for="image">Article Image</label>
                        <input type="file" class="form-control-file ml-3 mt-2" name="photo"/>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-12 text-center">
                        <input type="submit" value="CREATE" class="btn btn-primary pl-5 pr-5">
                    </div>
                </div>

            </form>
            </div>
        </div>
    </div>
</section>
@endsection
