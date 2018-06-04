@extends('layouts.app')
@section('content')
<form  method="post" action="/tickets/store" enctype="multipart/form-data">
{{method_field('POST')}}
{{csrf_field()}}
<label >Name </label>
<input type="text" name="name"/>
<br/>
<label >Price </label>
<input type="number" name="price"/>
<br/>
<label >description</label>
<textarea name="description"></textarea>
<br/>
<label >Quantity </label>
<input type="number" name="quantity"/>
<br/>
<label >Region </label>
<input type="text" name="region"/>
<br/>
<label >City </label>
<input type="text" name="city"/>
<br/>
<label >Expire Date </label>
<input type="date" name="expire_date"/>
<br/>
        <label for="image" class="col-md-4 col-form-label text-md-right">Ticket Image</label>
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
@endsection
