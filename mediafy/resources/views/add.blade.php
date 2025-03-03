<form method='POST' action="/product">
    @csrf

    <div>
        <label for="title">Title</label>
        <input name="title" id="title" type="text" />
    </div>
    <button type="submit">Create</button>
</form>