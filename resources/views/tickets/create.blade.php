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
<label >Region </label>
<input type="text" name="region" class="form-control"/>
<br/>
<label >City </label>
<input type="text" name="city" class="form-control"/>
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

@endsection

