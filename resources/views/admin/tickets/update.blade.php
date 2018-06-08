@extends('admin.index')
@section('content')

<form  method="post" action="/tickets/update/{{$ticket->id}}" enctype="multipart/form-data">
{{method_field('PUT')}}
{{csrf_field()}}
<label >Name </label>
<input type="text" value="{{$ticket->name}}" name="name"/>
<br/>
<label >Price </label>
<input type="number" value="{{$ticket->price}}" name="price"/>
<br/>
<label >description</label>
<textarea name="description">{{$ticket->description}}</textarea>
<br/>
<label >Quantity </label>
<input type="number" value="{{$ticket->quantity}}" name="quantity"/>
<br/>
<label >City </label>
<select name="city" id="city">
    @foreach(App\City::all() as $city)
      <option value="{{ $city->id }}"  {{ ($ticket->city_id == $city->id ) ? "selected" : "" }}>{{ $city->name }}</option>
    @endforeach
</select>
<br/>
<div id="toggleRegion">
    <label >Region </label>
    <select name="region" id="region">
        @foreach(App\City::find($ticket->city_id)->regions as $region)
      <option value="{{ $region->id }}"  {{ ($ticket->region_id == $region->id ) ? "selected" : "" }}>{{ $region->name }}</option>
       @endforeach
    </select>
</div>
<br/>
<label >Expire date </label>
<input type="date" value="{{$ticket->expire_date}}" name="expire_date"/>
<br/>
        <label for="image" class="col-md-4 col-form-label text-md-right">Ticket Image</label>
        <img src="{{ asset('storage/images/tickets/'. $ticket->photo) }}" style="width:150px; height:150px;"/>
        <input value="{{$ticket->photo}}" type="file" class="form-control-file"  name="photo">
<br/>
<label >Category</label>
<select name="category">
        @foreach($categories as $category)
          <option value="{{ $category->id }}" {{ ($ticket->category_id == $category->id ) ? "selected" : "" }}>{{ $category->name }}</option>
        @endforeach
      </select>
      <br/>
<input type="submit" value="Submit" class="btn btn-primary">
</form>

<script src="{{ asset('assets/js/lib/jquery/jquery.min.js') }}"></script>
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
