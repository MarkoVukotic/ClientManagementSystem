<table id="bestClientTable" class="table table-striped table-bordered table-sm" cellspacing="0" width="100%">
    <thead>
    <tr>
        <th class="th-sm">First name</th>
        <th class="th-sm">Last name</th>
        <th class="th-sm">Email</th>
        <th class="th-sm">Country</th>
        <th class="th-sm">Priority</th>
        <th class="th-sm">Number of Projects</th>
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
            <td>{{$client->project->count()}}</td>
        </tr>
    @endforeach
</table>
{{$clients->links()}}
