@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
    @role('admin') 
    <a href="/admin"  type="button" class="btn btn-default" >Admin Panel</a>
     @endrole
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Dashboard</div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success">
                            {{ session('status') }}
                        </div>
                    @endif

                    You are logged in!
                </div>
                
            </div>
        </div>
    </div>
</div>
@endsection
