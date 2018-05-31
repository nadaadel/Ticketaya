@extends('layouts.app')

@section('content')

<div class="jumbotron">
  <h1 class="display-4">Hello, world!</h1>
  <p class="lead">This is a simple hero unit, a simple jumbotron-style component for calling extra attention to featured content or information.</p>
  <hr class="my-4">
  <p id="reeed">It uses utility classes for typography and spacing to space content out within the larger container.</p>

    <input class="form-control mr-sm-2" type="search" placeholder="Search" aria-label="Search">
    <a class="btn btn-outline-success my-2 my-sm-0"  href={{ URL::to('tickets/search ') }} type="submit">Search</a>
  
</div>


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

