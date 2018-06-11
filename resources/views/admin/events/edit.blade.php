@extends('admin.index')
@section('content')

<form  method="post" action="/events/{{$event->id}}" enctype="multipart/form-data">
{{method_field('PUT')}}
{{csrf_field()}}
<label >Name </label>
<input type="text" name="name"  value={{$event->name}} />
@if ($errors->has('name'))
    <span class="alert alert-danger">
    <strong>{{ $errors->first('name') }}</strong>
    </span>
@endif

<br/>
<label >description</label>
<textarea name="description" value={{$event->description}} >{{$event->description}}</textarea>
@if ($errors->has('description'))
    <span class="alert alert-danger">
    <strong>{{ $errors->first('description') }}</strong>
    </span>
@endif
<br/>
<label >Quantity </label>
<input type="number" name="avaliabletickets" value={{$event->avaliabletickets}} />
@if ($errors->has('avaliabletickets'))
    <span class="alert alert-danger">
    <strong>{{ $errors->first('avaliabletickets') }}</strong>
    </span>
@endif
<br/>

<label >City </label>

<select name="city" id="city">
    @foreach(App\City::all() as $city)
      <option value="{{ $city->id }}"  {{ ($event->city_id == $city->id ) ? "selected" : "" }}>{{ $city->name }}</option>
    @endforeach
</select>


<br/>


      <div id="toggleRegion">
        <label >Region </label>
        <select name="region" id="region">
            @foreach(App\City::find($event->city_id)->regions as $region)
          <option value="{{ $region->id }}"  {{ ($event->region_id == $region->id ) ? "selected" : "" }}>{{ $region->name }}</option>
           @endforeach
        </select>
    </div>

 </br>

<label >Start Date </label>
<input type="date" name="startdate" value={{$event->startdate}}/>
<br/>
<label >End Date </label>
<input type="date" name="enddate" value={{$event->enddate}}/>
<br/>
<label for="image">Event Image</label>
<input type="file" class="form-control-file" name="photo" value={{$event->photo}}/>
@if ($errors->has('photo'))
    <span class="alert alert-danger">
    <strong>{{ $errors->first('photo') }}</strong>
    </span>
@endif
<br/>
<label >Category</label>
<select name="category">
        @foreach($categories as $category)
          <option value="{{ $category->id }}" >{{ $category->name }}</option>
        @endforeach
</select>
@if ($errors->has('category'))
    <span class="alert alert-danger">
    <strong>{{ $errors->first('category') }}</strong>
    </span>
@endif
<input type="submit" value="Submit" class="btn btn-success">
</form>
@endsection
