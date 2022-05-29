<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreProjectRequest;
use App\Models\Project;
use Illuminate\Http\Request;

class ProjectController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('project.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('project.create');

    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreProjectRequest $request)
    {
        try {
            Project::create($request->validated());
            return redirect('project.index')->with('success', 'New project have been created');
        } catch (\Exception $exception) {
            echo $exception->getMessage();
        }
    }

    /**
     * Display the specified resource.
     *
     * @param \App\Models\Project $project
     * @return \Illuminate\Http\Response
     */
    public function show(Project $project)
    {
        return view('project.show');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param \App\Models\Project $project
     * @return \Illuminate\Http\Response
     */
    public function edit(Project $project)
    {
        return view('project.edit');
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param \App\Models\Project $project
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Project $project)
    {
        try {
            $data = $request->get('data');
            $update_project = $project->update([
                'title' => $data['title'],
                'description' => $data['description'],
                'deadline' => $data['deadline'],
                'status' => $data['status'],
                'assigned_user' => $data['assigned_user'],
                'assigned_client' => $data['assigned_client'],
            ]);
            return output($update_project);

        } catch (\Exception $exception) {
            echo $exception->getMessage();
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param \App\Models\Project $project
     * @return \Illuminate\Http\Response
     */
    public function destroy(Project $project)
    {
        $delete_project = $project->delete();
        return output($delete_project);
    }

    public function softDeletedProjects()
    {
        try {
            $soft_deleted_projects = Project::withTrashed()->where('id', 1)->get();
            return output($soft_deleted_projects);

        } catch (\Exception $exception) {
            echo $exception->getMessage();
        }
    }

    public function forceDeleteSoftDeletedProjects()
    {
        try {
            $force_deleted_projects = Project::withTrashed()->where('id', 1)->forceDelete();
            return output($force_deleted_projects);

        } catch (\Exception $exception) {
            echo $exception->getMessage();
        }
    }
}
