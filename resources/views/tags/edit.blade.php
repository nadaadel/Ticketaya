<form method="POST" action="/tags/update/{{$tag->id}}">
    @csrf
    {{method_field('PUT')}}
    <label>Tag Name</label>
<input type="text" name="name" value="{{$tag->name}}">
    <input type="submit" value="Update">
</form>
