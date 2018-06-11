@extends('layouts.app')


@section('content')
<section>

<!-- main header in home page -->
        <section id="hero-home">
            <div class='slider'>
                <div class="overlay"></div>
                <div class='slide1'></div>
                <div class='slide2'></div>
                <div class='slide3'></div>
                <div class="content d-flex align-items-center">
                    <div class="container ">
                        <div class="row auto">
                          <div class="col-md-6 offset-md-3 text-center">
                            <h1>Tickets to Anywhere <br>
                                Here you will Find It</h1>
                                <p>There are many variations of passages of Lorem Ipsum available, but the majority have
                                   suffered alteration in some form, by injected humour,
                                   or randomised words which don't look even slightly believable.</p>
                          </div>
                        </div>
                        <div class="row">
                          <div class="col-md-6 offset-md-3 text-center">
                          <form method="GET" action="/tickets/search" enctype="multipart/form-data">
                              {{ csrf_field() }}
                            <input class="search" type="search" placeholder="Search Tickets, events or more..." aria-label="Search" name="search">
                            <button class="btn btn btn-primary search-btn" type="submit">Search</button>
                            </form>
                          </div>
                        </div>
                    </div>
                </div>
              </div>

              <div class="container">
                  <div class="row">


                  </div>
              </div>


        </section> <!-- End of header in home page -->
        <!-- <input class="form-control mr-sm-2" type="search" placeholder="Search" aria-label="Search"> -->


    <!-- <div class="row justify-content-center">
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
    </div> -->
  </section>
@endsection
