@extends('layouts.app')
@section('content')
@if (count($errors) > 0)
    <div class="alert alert-danger">
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif
<form  method="post" action="/events/store" enctype="multipart/form-data">
{{method_field('POST')}}
{{csrf_field()}}
<label >Name </label>
<input type="text" name="name"/>
<br/>
<label >description</label>
<textarea name="description"></textarea>
<br/>
<label >Quantity </label>
<input type="number" name="avaliabletickets"/>
<br/>
<label >City </label>
<select name="city" id="city">
    @foreach(App\City::all() as $city)
      <option value="{{$city->id}}">{{$city->name}}</option>
    @endforeach
</select>
<br/>
<div id="toggleRegion" style="display: none;">
    <label >Region </label>
    <select name="region" id="region">
    </select>
</div>
<br/>

<label >Start Date </label>
<input type="datetime-local" name="startdate"/>
<br/>
<label >End Date </label>
<input type="date" name="enddate"/>
<br/>
<label for="image">Event Image</label>
<input type="file" class="form-control-file" name="photo"/>
<br/>
<label >Category</label>
<select name="category">
        @foreach($categories as $category)
          <option value="{{ $category->id }}">{{ $category->name }}</option>
        @endforeach
      </select>
      <br/>
<input type="submit" value="Submit" class="btn btn-primary">
</form>

<script>
        $(document).ready( function(){
            $('#city').on('change',function(){
            var city_id = $(this).val();
            $('#region').empty();
            $.ajax({
                     url: '/cities/'+city_id,
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
