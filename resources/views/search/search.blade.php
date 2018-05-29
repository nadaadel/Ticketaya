@extends('layouts.app')
@section('content')
<div class="container">
    <section class="search-page">
        <div class="row">
                <div class="col-md-12 col-xs-12">
                        <form class="form-inline">
                                <input class="form-control mr-sm-2" type="search" placeholder="Search" aria-label="Search">
                                <button class="btn btn-outline-success my-2 my-sm-0" type="submit">Search</button>
                              </form>
                </div>
        </div>
    </section>
    <section>
        <div class="row">
            <div class="col-md-3">
                <form method="GET" action="/tickets/filter">
                    <div id="accordion">
                            <div class="card">
                              <div class="card-header" id="headingOne">
                                <h5 class="mb-0">
                                  <a class="btn btn-link" data-toggle="collapse" data-target="#collapseOne" aria-expanded="true" aria-controls="collapseOne">
                                    Price
                                </a>
                                </h5>
                              </div>
                          
                              <div id="collapseOne" class="collapse show" aria-labelledby="headingOne" data-parent="#accordion">
                                <div class="card-body">
                                  <ul>
                                      <li>
                                          <input type="checkbox"> 50-100
                                      </li>
                                      <li>
                                            <input type="checkbox"> 150-200
                                      </li>
                                      <li>
                                            <input type="checkbox"> 250-300
                                      </li>
                                      <li>
                                            <input type="checkbox"> 300 or more
                                      </li>
                                  </ul>
                                </div>
                              </div>
                            </div>
                            <div class="card">
                              <div class="card-header" id="headingTwo">
                                <h5 class="mb-0">
                                  <a class="btn btn-link collapsed" data-toggle="collapse" data-target="#collapseTwo" aria-expanded="false" aria-controls="collapseTwo">
                                    Category
                                </a>
                                </h5>
                              </div>
                              <div id="collapseTwo" class="collapse" aria-labelledby="headingTwo" data-parent="#accordion">
                                <div class="card-body">
                                        <ul>
                                           <li>
                                                <input type="checkbox"> Sport
                                            </li>
                                             <li>
                                                <input type="checkbox"> Train
                                            </li>
                                            <li>
                                               <input type="checkbox"> Concert
                                            </li>
                                            <li>
                                                 <input type="checkbox"> Festival
                                            </li>
                                        </ul>

                                </div>
                              </div>
                            </div>
                            <div class="card">
                              <div class="card-header" id="headingThree">
                                <h5 class="mb-0">
                                  <a class="btn btn-link collapsed" data-toggle="collapse" data-target="#collapseThree" aria-expanded="false" aria-controls="collapseThree">
                                    Location
                                </a>
                                </h5>
                              </div>
                              <div id="collapseThree" class="collapse" aria-labelledby="headingThree" data-parent="#accordion">
                                <div class="card-body">
                                        <ul>
                                                <li>
                                                     <input type="checkbox" name="city" value="cairo"> Cairo
                                                 </li>
                                                  <li>
                                                     <input type="checkbox" value="alex"> Alexandria
                                                 </li>
                                                 
                                             </ul>
                                </div>
                              </div>
                            </div>
                          </div>
                          <input type="submit" value="Apply">
                    </form>
            </div>
            <div class="col-md-9">
                <div class="row">
                    <div class="col-md-4 col-xs-12 tick-search">
                            <div class="card" style="width: 18rem;">
                                    <img class="card-img-top" src="http://via.placeholder.com/350x150" alt="Card image cap">
                                    <div class="card-body">
                                      <h5 class="card-title">Card title</h5>
                                      <p class="card-text">Some quick example text to build on the card title and make up the bulk of the card's content.</p>
                                      <a href="#" class="btn btn-primary">Request This ticket</a>
                                    </div>
                                  </div>
                    </div>
                    <div class="col-md-4 col-xs-12 tick-search">
                            <div class="card" style="width: 18rem;">
                                    <img class="card-img-top" src="http://via.placeholder.com/350x150" alt="Card image cap">
                                    <div class="card-body">
                                      <h5 class="card-title">Card title</h5>
                                      <p class="card-text">Some quick example text to build on the card title and make up the bulk of the card's content.</p>
                                      <a href="#" class="btn btn-primary">Request This ticket</a>
                                    </div>
                                  </div>
                    </div>
                    <div class="col-md-4 col-xs-12 tick-search">
                            <div class="card" style="width: 18rem;">
                                    <img class="card-img-top" src="http://via.placeholder.com/350x150" alt="Card image cap">
                                    <div class="card-body">
                                      <h5 class="card-title">Card title</h5>
                                      <p class="card-text">Some quick example text to build on the card title and make up the bulk of the card's content.</p>
                                      <a href="#" class="btn btn-primary">Request This ticket</a>
                                    </div>
                                  </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
</div>
@endsection