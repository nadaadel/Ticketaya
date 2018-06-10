@extends('layouts.app')
@section('content')

<section class="editing-forms">
    <div class="container">
        <div class="row mt-5 mb-5">
            <div class="col-md-12 text-center">
                <h2>Update Ticket Details</h2>
            </div>
        </div>
        <div class="row justify-content-md-center">
            <div class="col-md-6">
               
            <form  method="post" action="/tickets/update/{{$ticket->id}}" enctype="multipart/form-data">
                {{method_field('PUT')}}
                {{csrf_field()}}
                <div class="row">
                    <div class="col-md-12">
                       <label >Ticket Name</label>
                        <input type="text" value="{{$ticket->name}}" name="name" class="form-control">
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-6">
                       <label >Ticket Price</label>
                        <input type="number" value="{{$ticket->price}}" name="price" class="form-control">
                    </div>
                    <div class="col-md-6">
                       <label >Ticket Quantity</label>
                        <input type="number" value="{{$ticket->quantity}}" name="quantity" class="form-control">
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-6">
                       <label >Ticket Category</label>
                        <select name="category" class="w-100">
                        @foreach($categories as $category)
                          <option value="{{ $category->id }}" {{ ($ticket->category_id == $category->id ) ? "selected" : "" }}>{{ $category->name }}</option>
                        @endforeach
                      </select>
                    </div>
                    <div class="col-md-6">
                        <label >Ticket Expire Date </label>
                        <input type="date" value="{{$ticket->expire_date}}" name="expire_date" class="form-control">
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-6 " >
                        <label >City </label>
                        <select name="city" id="city" class="w-100">
                            @foreach(App\City::all() as $city)
                              <option value="{{ $city->id }}">{{ $city->name }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="col-md-6">
                        <label >Region </label>
                        <input type="text" value="{{$ticket->region}}" name="region" class="form-control">
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-12">
                        <label >description</label>
                        <textarea name="description" class="form-control txt-area">{{$ticket->description}}</textarea>
                    </div>
                </div>
<!--
                <div class="row">
                    <div class="col-md-12">
                        <label >Tags</label>
                        <input type="text" name="tags" class="form-control" placeholder="Add Tags Sperated by comma">
                    </div>
                </div>
-->
                
                <div class="row">
                    <div class="col-md-6">
                       <label for="image">Ticket Image</label>
                       <img src="{{ asset('storage/images/tickets/'. $ticket->photo) }}" style=" height:150px;"/>
                        <input type="file" class="form-control-file ml-3 mt-2" name="photo"/>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-12 text-center">
                        <input type="submit" value="SUBMIT" class="btn btn-primary pl-5 pr-5">
                    </div>
                </div>
            
            </form>
            </div>
        </div>
    </div>
</section>
<!--
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
-->

@endsection