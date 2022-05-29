<form name="add-blog-post-form" id="add-blog-post-form" method="post" class="needs-validation"
      action="{{route('client.store')}}">
    @csrf
    <div class="form-group mb-3">
        <label for="first_name">First Name</label>
        <input type="text" id="first_name" name="first_name" class="form-control" value="{{old('first_name')}}">
    </div>
    @error('first_name')
    <div class="text-danger mb-2">{{$message}}</div>
    @enderror

    <div class="form-group mb-3">
        <label for="last_name">Last Name</label>
        <input type="text" id="last_name" name="last_name" class="form-control" value="{{old('last_name')}}">
    </div>
    @error('last_name')
    <div class="text-danger mb-2">{{$message}}</div>
    @enderror

    <div class="form-group mb-3">
        <label for="email">Email</label>
        <input type="email" id="email" name="email" class="form-control" value="{{old('email')}}">
    </div>
    @error('email')
    <div class="text-danger mb-2">{{$message}}</div>
    @enderror

    <div class="form-group mb-3">
        <label for="country">Country</label>
        <input type="text" id="country" name="country" class="form-control" value="{{old('country')}}">
    </div>
    @error('country')
    <div class="text-danger mb-2">{{$message}}</div>
    @enderror

    <div class="form-group mt-4">
        <label for="priority">Priority</label>
        <select class="form-select" id="priority" name="priority" aria-label="Client priority select">
            <option value="low">Low</option>
            <option value="medium">Medium</option>
            <option value="high">High</option>
        </select>
    </div>
    <button type="submit" class="btn btn-success mt-4">Create</button>
</form>
