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
<label >Region </label>
<input type="text" name="region" value={{$event->region}}/>
@if ($errors->has('region'))
    <span class="alert alert-danger">
    <strong>{{ $errors->first('region') }}</strong>
    </span>
@endif
<br/>
<label >City </label>
<input type="text" name="city" value={{$event->city}}/>
@if ($errors->has('city'))
    <span class="alert alert-danger">
    <strong>{{ $errors->first('city') }}</strong>
    </span>
@endif
<br/>

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
