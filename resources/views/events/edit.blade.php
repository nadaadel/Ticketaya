@extends('layouts.app')
@section('content')

<section class="editing-forms">
        <div class="container">
            <div class="row mt-5 mb-5">
                <div class="col-md-12 text-center">
                    <h2>Update Event Details</h2>
                </div>
            </div>
            <div class="row justify-content-md-center">
                <div class="col-md-6">

                <form method="post" action="/events/{{$event->id}}" enctype="multipart/form-data">
                    {{method_field('PUT')}}
                    {{csrf_field()}}
                    <div class="row">
                        <div class="col-md-12">
                           <label >Event Name</label>
                            <input type="text" value="{{$event->name}}" name="name" class="form-control">
                            @if ($errors->has('name'))
                            <span class="alert alert-danger">
                            <strong>{{ $errors->first('name') }}</strong>
                            </span>
                        @endif
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                           <label >Avaliable Tickets </label>
                            <input type="number" value="{{$event->avaliabletickets}}" name="avaliabletickets" class="form-control">
                            @if ($errors->has('avaliabletickets'))
                                <span class="alert alert-danger">
                                <strong>{{ $errors->first('avaliabletickets') }}</strong>
                                </span>
                            @endif
                        </div>
                        <div class="col-md-6">
                                <label >Event Category</label>
                                 <select name="category" class="w-100">
                                     @foreach($categories as $category)
                                         <option value="{{ $category->id }}" >{{ $category->name }}</option>
                                       @endforeach
                                     @if ($errors->has('category'))
                                         <span class="alert alert-danger">
                                         <strong>{{ $errors->first('category') }}</strong>
                                         </span>
                                     @endif
                               </select>
                             </div>
                    </div>

                    <div class="row">
                            <div class="col-md-6">
                                    <label >Start Date </label>
                                    <input type="date" class="w-100" name="startdate" value={{$event->startdate}}/>
                            </div>
                            <div class="col-md-6">
                                    <label >End Date </label>
                                    <input class="w-100" type="date" name="enddate" value={{$event->enddate}}/>
                            </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6 " >
                            <label >City </label>
                            <select name="city" id="city" class="w-100">
                                    @foreach($cities as $city)
                                        <option value="{{$city->id}}" {{ ($event->city_id == $city->id ) ? "selected" : "" }}>{{$city->name}}</option>
                                    @endforeach
                                </select>
                               @if ($errors->has('city'))
                                     <span class="alert alert-danger">
                                         <strong>{{ $errors->first('city') }}</strong>
                                     </span>
                                @endif
                        </div>

                        <div class="col-md-6 " >
                            <label >Region</label>
                            <select name="region" id="region" class="w-100">
                                    @if($event->region_id)
                                       @foreach($regions as $region)
                                           <option value="{{$region->id}}" {{ ($event->region_id == $region->id ) ? "selected" : "" }}>{{$region->name}}</option>
                                       @endforeach
                                    @endif
                                       </select>
                                   @if ($errors->has('region'))
                                        <span class="alert alert-danger">
                                             <strong>{{ $errors->first('region') }}</strong>
                                        </span>
                                   @endif
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-12">
                            <label >description</label>
                            <textarea name="description" class="form-control txt-area">{{$event->description}}</textarea>
                            @if ($errors->has('description'))
                            <span class="alert alert-danger">
                            <strong>{{ $errors->first('description') }}</strong>
                            </span>
                        @endif
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-6">
                         <label for="image">Event Image</label>
                           <img src="{{ asset('storage/images/events/'. $event->photo) }}" style=" height:150px;"/>
                           <input type="file" class="form-control-file ml-3 mt-2" name="photo"/>
                           @if ($errors->has('photo'))
                            <span class="alert alert-danger">
                            <strong>{{ $errors->first('photo') }}</strong>
                            </span>
                          @endif
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
























<script>
$(document).ready(function(){
    $('#city').on('change',function(){
        var cityId=$(this).val();
        console.log(cityId)
        $('#region').empty();
        $.ajax({
            url: '/cities/'+cityId,
            type: 'GET' ,
            data:{
                 '_token':'@csrf'
             },
            success:function(response){
                if(response.res == 'success'){
                $.each(response.cityRegions, function(index,region){
                var option=`<option value="`+region.id+`">`+region.name+`</option>`;
                $('#region').append(option);
            });
            $('#toggleRegion').show();
            }

            }
        });
    });
});


</script>
@endsection
