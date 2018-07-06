@extends('admin.index')
@section('content')
<section class="user-profile">
        <div class="container">
            <div class="row mt-5">
                <div class="col-md-12 text-center">
                           <img width=200px height=200px src="{{ asset('storage/images/categories/'.$category->photo) }}">
            </div>
            <div class="col-md-12 text-center"><h2>{{$category->name}}</h2></div>
        </div>
    </section>

@endsection
