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
<form  method="post" action="/tickets/store" enctype="multipart/form-data">
{{method_field('POST')}}
{{csrf_field()}}
<label >Name </label>
<input type="text" name="name" class="form-control"/>
<br/>
<label >Price </label>
<input type="number" name="price" class="form-control"/>
<br/>
<label >description</label>
<textarea name="description" class="form-control"></textarea>
<br/>
<label >Quantity </label>
<input type="number" name="quantity" class="form-control"/>
<br/>
<label >City </label>
<select name="city" id="city">
    @foreach(App\City::all() as $city)
      <option value="{{ $city->id }}">{{ $city->name }}</option>
    @endforeach
</select>
<br/>
<div id="toggleRegion" style="display: none;">
    <label >Region </label>
    <select name="region" id="region">
    </select>
</div>
<br/>
<label >Expire Date </label>
<input type="datetime-local" name="expire_date" class="form-control"/>
<br/>
<label for="image">Ticket Image</label>
<input type="file" class="form-control-file" name="photo"/>
<br/>
<label >Tags</label>    
<input type="text" name="tags" class="form-control"/>
<label >Category</label>
<select name="category">
        @foreach($categories as $category)
          <option value="{{ $category->id }}">{{ $category->name }}</option>
        @endforeach
      </select>
<input type="submit" value="Submit" class="btn btn-primary">
</form>
<script>
$(document).ready( function(){
    $('#city').on('change',function(){
    var city_id = $(this).val();
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

