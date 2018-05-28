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
<label >Region </label>
<input type="text" value="{{$ticket->region}}" name="region"/>
<br/>
<label >City </label>
<input type="text" value="{{$ticket->city}}" name="city"/>
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
<input type="submit" value="Submit" class="btn btn-primary">
</form>

