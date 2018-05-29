
            <fieldset>
                <legend style="background-color: gray">Ticket Info </legend>
                <img src="{{ asset('storage/images/tickets/'. $ticket->photo) }}" style="width:150px; height:150px;">
                <p>Name : {{ $ticket->name }}</p>
                <p>Quantity:{{ $ticket->quantity }}</p>
                <p>Description:{{ $ticket->description }}</p>
                <p>Price :{{ $ticket->price }}</p>
                <p>Date :{{ $ticket->expire_date }}</p>
                <p>Category :{{ $ticket->category_id }}</p>
                <p>Location:{{ $ticket->region }},{{ $ticket->city }}</p>
                <p>Created by :{{ $ticket->user->name }} </p>
               <hr>
            </fieldset>


