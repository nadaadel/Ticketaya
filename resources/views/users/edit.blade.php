@extends('layouts.app')
@section('content')
<section>
    <div class="container">
        <div class="row mt-4 mb-2">
            <div class="col-md-12 text-center">
                <h2>Edit Your Profile</h2>
            </div>
        </div>
        <div class="row justify-content-md-center">
            <div class="col-md-6">
                <form  method="post" action="/users/{{$user->id}}" enctype="multipart/form-data">
                    {{method_field('PUT')}}
                    {{csrf_field()}}
                    <div class="form-group row">
                      <label class="col-md-4 col-form-label text-md-right" >Name </label>
                        <div class="col-md-6">
                            <input type="text" name="name"  value="{{$user->name}}" class="form-control">
                            @if ($errors->has('name'))
                                 <span class="alert alert-danger">
                                    <strong>{{ $errors->first('name') }}</strong>
                                 </span>
                            @endif
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-md-4 col-form-label text-md-right" >Phone Number </label>
                            <div class="col-md-6">
                                <input type="text" name=phone value="{{$user->phone}}" class="form-control" required>
                                @if ($errors->has('phone'))
                                     <span class="alert alert-danger">
                                        <strong>{{ $errors->first('phone') }}</strong>
                                     </span>
                                @endif
                            </div>
                    </div>

                    <div class="form-group row">
                        <label class="col-md-4 col-form-label text-md-right" >Email </label>
                            <div class="col-md-6">
                                <input type="text" name=email value="{{$user->email}}" class="form-control">
                                @if ($errors->has('email'))
                                     <span class="alert alert-danger">
                                        <strong>{{ $errors->first('email') }}</strong>
                                     </span>
                                @endif
                            </div>
                    </div>



                    <div class="form-group row">
                         <label class="col-md-4 col-form-label text-md-right">City </label>
                            <div class="col-md-6">
                                <select name="city" id="city" class="w-100">
                                    @foreach($cities as $city)
                                        <option value="{{$city->id}}" {{ ($user->city_id == $city->id ) ? "selected" : "" }}>{{$city->name}}</option>
                                    @endforeach
                                </select>
                               @if ($errors->has('city'))
                                     <span class="alert alert-danger">
                                         <strong>{{ $errors->first('city') }}</strong>
                                     </span>
                                @endif
                            </div>
                    </div>

                    <div class="form-group row" id="toggleRegion"  >
                           <label class="col-md-4 col-form-label text-md-right">Region </label>
                                <div class="col-md-6" >

                                    <select name="region" id="region" class="w-100">
                                    @if($user->region_id)
                                    @foreach($regions as $region)
                                        <option value="{{$region->id}}" {{ ($user->region_id == $region->id ) ? "selected" : "" }}>{{$region->name}}</option>
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


                    <div class="form-group row">
                    <label for="image" class="col-md-4 col-form-label text-md-right">Profile Picture</label>
                    <div class="col-md-6">
                    <input type="file" class="form-control-file" name="avatar" value={{$user->avatar}}/>
                    @if ($errors->has('avatar'))
                        <span class="alert alert-danger">
                        <strong>{{ $errors->first('avatar') }}</strong>
                        </span>
                    @endif
                    </div>

                    </div>

                    <div class="row">
                        <div class="col-md-12 text-center mt-3">
                            <input type="submit" value="Submit" class="btn btn-primary">
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
        })


    });
});


</script>
@endsection

