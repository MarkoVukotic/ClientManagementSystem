<table id="dtBasicExample" class="table table-striped table-bordered table-sm" cellspacing="0" width="100%">
    <thead>
    <tr>
        <th class="th-sm">First name</th>
        <th class="th-sm">Last name</th>
        <th class="th-sm">Email</th>
        <th class="th-sm">Country</th>
        <th class="th-sm">Priority</th>
        <th class="th-sm">Action</th>
    </tr>
    </thead>
    <tbody>
    @foreach($clients as $client)
        <tr>
            <td>{{$client->first_name}}</td>
            <td>{{$client->last_name}}</td>
            <td>{{$client->email}}</td>
            <td>{{$client->country}}</td>
            <td>{{$client->priority}}</td>
            <td><a href="client/{{$client->id}}/edit" class="btn btn-info">Edit</a></td>
            <td><a href="client/deleteClient/?id={{$client->id}}" class="btn btn-danger">Delete</a></td>

        </tr>
    @endforeach
</table>
{{$clients->links()}}
