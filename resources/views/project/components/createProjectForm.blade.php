<form name="create_project_form" id="create_project_form" method="post" class="needs-validation"
      action="{{route('project.store')}}">
    @csrf
    <div class="form-group mb-3">
        <label for="title">Title</label>
        <input type="text" id="title" name="title" class="form-control" value="{{old('title')}}">
    </div>
    @error('title')
        <div class="text-danger mb-2">{{$message}}</div>
    @enderror
    <div class="form-group mb-3">
        <label for="description">Description</label>
        <textarea id="description" name="description" class="form-control">{{old('description')}}</textarea>
    </div>
    @error('description')
    <div class="text-danger mb-2">{{$message}}</div>
    @enderror
    <div class="form-group mb-3">
        <label for="deadline">Deadline</label>
        <input type="date" id="deadline" name="deadline" class="form-control" value="{{old('deadline')}}">
    </div>
    @error('deadline')
    <div class="text-danger mb-2">{{$message}}</div>
    @enderror
    <div class="form-group mt-4">
        <select class="form-select" id="assigned_user" name="assigned_user" aria-label="Assigned user select">
            <option selected>Assigned User</option>
            @foreach($users as $user)
                <option value={{$user['id']}}>{{$user['name']}}</option>
            @endforeach
        </select>
    </div>
    <div class="form-group mt-4">
        <select class="form-select" id="assigned_client" name="client_id" aria-label="Assigned client select">
            <option selected>Assigned client</option>
            @foreach($clients as $client)
                <option value={{$client['id']}}>{{$client['first_name']}}</option>
            @endforeach
        </select>
    </div>
    <div class="form-group mt-4">
        <select class="form-select" id="status" name="status" aria-label="Project status select">
            <option selected>Status</option>
            <option value="open">Open</option>
            <option value="closed">Closed</option>
        </select>
    </div>

    <button type="submit" class="btn btn-success mt-4">Create</button>
</form>
