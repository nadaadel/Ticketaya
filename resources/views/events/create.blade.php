@extends('layouts.app')
@section('content')
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
<label >Location </label>
<input type="text" name="location"/>
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
@endsection