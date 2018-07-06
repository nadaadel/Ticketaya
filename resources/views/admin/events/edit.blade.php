@extends('admin.index')
@section('content')

<section class="editing-forms">
        <div class="container">
            <div class="row mt-5 mb-5">
                <div class="col-md-12 text-center">
                    <h2>Update Ticket Details</h2>
                </div>
            </div>
            <div class="row justify-content-md-center">
                <div class="col-md-6">

                        <form  method="post" action="/events/{{$event->id}}" enctype="multipart/form-data">
                            {{method_field('PUT')}}
                            {{csrf_field()}}


                            <div class="row">
                               <div class="col-md-12">
                                  <label >Event Name</label>
                                  <input type="text" name="name"  value="{{$event->name}}" class="form-control">
                                </div>
                             </div>
                             <div class="row">
                                 <div class="col-md-12">
                                   <label >description</label>
                                   <textarea name="description" value="{{$event->description}}" class="form-control txt-area">{{$event->description}}</textarea>
                                  </div>
                            </div>

                             <div class="row">
                        
                                <div class="col-md-6">
                                   <label >Ticket Quantity</label>
                                   <input type="number" type="number" name="avaliabletickets" value="{{$event->avaliabletickets}}"  class="form-control">
                                 </div>
                            </div>


                             <div class="row">
                                <div class="col-md-6">
                                      <label >Event Category</label>
                                       <select name="category" class="w-100">
                                          @foreach($categories as $category)
                                           <option value="{{ $category->id }}" {{ ($event->category_id == $category->id ) ? "selected" : "" }}>{{ $category->name }}</option>
                                          @endforeach
                                         </select>
                        </div>
                        <div class="col-md-6">
                            <label > Start Date </label>
                            <input type="datetime"  name="startdate" value="{{$event->startdate}}" class="form-control">
                        </div>
                        <div class="col-md-6">
                            <label >End Expire Date </label>
                            <input type="datetime"  name="enddate" value={{$event->enddate}}class="form-control">
                        </div>
                    </div>



                     <div class="row">
                         <div class="col-md-6 " >
                         <label >City </label>

                                <select name="city" id="city">
                                          @foreach(App\City::all() as $city)
                                           <option value="{{ $city->id }}"  {{ ($event->city_id == $city->id ) ? "selected" : "" }}>{{ $city->name }}</option>
                                          @endforeach
                                </select>


                        </div>

                        <div class="col-md-6 " >
                                 <div id="toggleRegion">
                                     <label >Region </label>
                                         <select name="region" id="region">
                                                  @foreach(App\City::find($event->city_id)->regions as $region)
                                                   <option value="{{ $region->id }}"  {{ ($event->region_id == $region->id ) ? "selected" : "" }}>{{ $region->name }}</option>
                                                  @endforeach
                                           </select>
                                 </div>

                        </div>


                    </div>


                   <div class="row">
                        <div class="col-md-6">
                           <label for="image">Event Image</label>
                           <img src="{{ asset('storage/images/events/'. $event->photo) }}" style=" height:150px;"/>
                            <input type="file" class="form-control-file ml-3 mt-2" name="photo"/>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12 text-center">
                            <input type="submit" value="SUBMIT" class="btn btn-primary pl-5 pr-5">
                        </div>
                    </div>
</form>
@endsection
