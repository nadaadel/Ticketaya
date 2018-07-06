@extends('admin.index')
@section('content')
<section class="editing-forms">
        <div class="container">
            <div class="row mt-4 mb-2">
                <div class="col-md-12 text-center">
                    <h2>Create a New Tag</h2>
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
                <form method="POST" action="/tags/update/{{$tag->id}}">
                    @csrf
                    {{method_field('PUT')}}
                    <div class="row">
                        <div class="col-md-12">
                            <label>Tag Name</label>
                            <input type="text" name="name" class="form-control" value="{{$tag->name}}">
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
