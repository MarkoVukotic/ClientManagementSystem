<table id="projectIndexTable" class="table table-striped table-bordered table-sm" cellspacing="0" width="100%">
    <thead>
    <tr>
        <th class="th-sm">Title</th>
        <th class="th-sm">Description</th>
        <th class="th-sm">Deadline</th>
        <th class="th-sm">Status</th>
        <th class="th-sm">Assigned User</th>
        <th class="th-sm">Client</th>
    </tr>
    </thead>
    <tbody>
    @foreach($projects as $project)
        <tr>
            <td>{{$project->title}}</td>
            <td>{{$project->description}}</td>
            <td>{{$project->deadline}}</td>
            <td>{{$project->status}}</td>
            <td>{{$project->assigned_user->name}}</td>
            <td>{{$project->client->first_name}}</td>
            <td><a href="project/display/{{$project->id}}" class="btn btn-warning">Info</a></td>
            <td><a href="project/{{$project->id}}/edit" class="btn btn-info">Edit</a></td>
            <td><a href="project/deleteProject/?id={{$project->id}}" class="btn btn-danger">Delete</a></td>
        </tr>
    @endforeach
</table>
{{$projects->links()}}
