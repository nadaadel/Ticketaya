@extends('admin.index')
@section('content')
<div class="container">
        <div class="row mt-3 mb-3">
                <div class="col-md-9 col-xs-12">
                   <div class="search-content d-flex">
                       <form method="get" action="/events/search" enctype="multipart/form-data" class="text-right">
                        {!! csrf_field() !!}
                        <input class="search pgs-search" type="search" placeholder="Search for new events or more..." aria-label="Search" name="search">
                        <button class="btn btn btn-secondary search-btn pgs-search-btn" type="submit">Search</button>
                       </form>
                   </div>
                </div>
        </div>
    <div class="row">
            <div class="col-md-6"></div>
            <div class="col-md-6 text-right"><a href="{{ URL::to('events/create' )}} " ><input type="button" class="btn btn-primary ml-5" value='Add New Event'/></a></div>
    </div>
    <div class="row">
  <table class="table table-hover ">
    <thead>
      <tr>
        <th scope="col">#</th>
        <th scope="col">Name</th>
        <th scope="col">Photo</th>
        <th scope="col">Category</th>
        <th scope="col">Avaliable Ticket</th>   
        <th scope="col">Created By</th>
        <th scope="col">start at </th>
        <th scope="col">End at </th>
        <th scope="col" colspan='2'>Actions</th>
      </tr>
    </thead>
    <tbody>
  @foreach($events as $event)

  <tr class="danger" id="{{$event->id}}">


        <th scope="row">{{$event->id}}</th>
        <td><a href="{{ route('eventshow', ['id' => $event->id]) }}">{{ucwords($event->name)}}</a></td>
        <td><img src="{{ asset('storage/images/events/'. $event->photo) }}" style="width:160px; height:120px;"></td>
      
        <td>{{$event->category->name}}</td>
        <td>{{$event->avaliabletickets}}</td>
        <td><a href="{{ route('showuser', ['id' => $event->user_id])}}">{{$event->user->name}}</a></td>

        <td> {{ $event->startdate }} </td>
        <td>{{ $event->enddate}}</td>
        <td><a href={{ URL::to('events/edit/' . $event->id ) }} type="button" class="btn btn-warning" >Edit</a></td>
        <td> <a event-id="{{$event->id}}" class="btn ctrl-btn  deletebtn"><i class="far fa-trash-alt"></i></a></td>
  </tr>

  @endforeach
  </tbody>
  </table>
  {{ $events->links() }}
</div>
  </div>
  </div>




@endsection


