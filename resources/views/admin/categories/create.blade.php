@extends('admin.index')
@section('content')
<section class="editing-forms">
        <div class="container">
            <div class="row mt-4 mb-2">
                <div class="col-md-12 text-center">
                    <h2>Create a New Category</h2>
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
                <form method="POST" action="/categories" enctype="multipart/form-data">
                    @csrf
                    <div class="row">
                        <div class="col-md-12">
                            <label>Category Name</label>
                            <input type="text" name="name" class="form-control" placeholder="Enter Category Name">
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12">
                            <label for="image">Category Image</label>
                            <input type="file" class="form-control-file ml-3 mt-2" name="photo"/>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12 text-center">
                            <input type="submit" value="Create" class="btn btn-primary pl-5 pr-5">
                        </div>
                    </div>

                </form>
                </div>
            </div>
        </div>
    </section>
@endsection
