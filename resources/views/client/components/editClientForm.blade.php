<form name="add-blog-post-form" id="add-blog-post-form" method="post" class="needs-validation"
      action="/client/{{$client->id}}">
    @csrf
    @method('patch')
    <div class="form-group mb-3">
        <label for="first_name">First Name</label>
        <input type="text" id="first_name" name="first_name" class="form-control" value="{{$client->first_name}}">
    </div>
    @error('first_name')
    <div class="text-danger mb-2">{{$message}}</div>
    @enderror

    <div class="form-group mb-3">
        <label for="last_name">Last Name</label>
        <input type="text" id="last_name" name="last_name" class="form-control" value="{{$client->last_name}}">
    </div>
    @error('last_name')
    <div class="text-danger mb-2">{{$message}}</div>
    @enderror

    <div class="form-group mb-3">
        <label for="email">Email</label>
        <input type="email" id="email" name="email" class="form-control" value="{{$client->email}}">
    </div>
    @error('email')
    <div class="text-danger mb-2">{{$message}}</div>
    @enderror

    <div class="form-group mb-3">
        <label for="country">Country</label>
        <input type="text" id="country" name="country" class="form-control" value="{{$client->country}}">
    </div>
    @error('country')
    <div class="text-danger mb-2">{{$message}}</div>
    @enderror

    <div class="form-group mt-4">
        <label for="priority">Priority</label>
        <select class="form-select" id="priority" name="priority" aria-label="Client priority select">
            @switch($client->priority)
                @case('low')
                <option selected value="low">Low</option>
                <option value="medium">Medium</option>
                <option value="high">High</option>
                @break

                @case('medium')
                <option value="low">Low</option>
                <option selected value="medium">Medium</option>
                <option value="high">High</option>
                @break

                @case('high')
                <option value="low">Low</option>
                <option value="medium">Medium</option>
                <option selected value="high">High</option>
                @break
            @endswitch
        </select>
    </div>


    <button type="submit" class="btn btn-primary mt-4">Edit</button>
</form>
