<form method="POST" action="/tags/store">
    @csrf
    <label>Tag Name</label>
    <input type="text" name="name">
    <input type="submit" value="Create">
</form>
