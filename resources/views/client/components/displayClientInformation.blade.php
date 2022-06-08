<table id="displayClientInformation" class="table table-striped table-bordered table-sm" cellspacing="0" width="100%">
    <thead>
    <tr>
        <th class="th-sm">First name</th>
        <th class="th-sm">Last name</th>
        <th class="th-sm">Email</th>
        <th class="th-sm">Country</th>
        <th class="th-sm">Priority</th>
        <th class="th-sm">Number of Projects</th>
        <th class="th-sm">Name of the Projects</th>
        <th class="th-sm">Number of Finished Tasks</th>
        <th class="th-sm">Money</th>
    </tr>
    </thead>
    <tbody>
        <tr>
            <td>{{$client->first_name}}</td>
            <td>{{$client->last_name}}</td>
            <td>{{$client->email}}</td>
            <td>{{$client->country}}</td>
            <td>{{$client->priority}}</td>
            <td>{{$client->project->count()}}</td>
            <td>Test 1, Test 2, Test 3</td>
            <td>45</td>
            <td>500 euros</td>
        </tr>
</table>
