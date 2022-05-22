

<!--
            'status' => 'required',
            'assigned_user' => 'required',
            'assigned_client' => 'required',
-->

<form name="add-blog-post-form" id="add-blog-post-form" method="post" action="{{route('project.store')}}">
    @csrf
    <div class="form-group">
        <label for="title">Title</label>
        <input type="text" id="title" name="title" class="form-control" required="">
    </div>
    <div class="form-group">
        <label for="description">Description</label>
        <textarea id="description" name="description" class="form-control" required=""></textarea>
    </div>
    <div class="form-group">
        <label for="deadline">Deadline</label>
        <input type="date" id="deadline" name="deadline" class="form-control" required="">
    </div>
    <div class="form-group mt-4">
        <select class="form-select" id="assigned_user" name="assigned_user" aria-label="Assigned user select">
            <option selected>Assigned User</option>
            <option value="1">Marko</option>
            <option value="2">Nikola</option>
            <option value="3">Luka</option>
        </select>
    </div>
    <div class="form-group mt-4">
        <select class="form-select" id="assigned_client" name="assigned_client" aria-label="Assigned client select">
            <option selected>Assigned client</option>
            <option value="1">Hipotekarna banka</option>
            <option value="2">Sicilija</option>
            <option value="3">MsdAdriatic</option>
        </select>
    </div>
    <div class="form-group mt-4">
        <select class="form-select" id="status" name="status" aria-label="Project status select">
            <option selected>Status</option>
            <option value="open">Open </option>
            <option value="closed">Closed </option>
        </select>
    </div>

    <button type="submit" class="btn btn-primary mt-4">Submit</button>
</form>
