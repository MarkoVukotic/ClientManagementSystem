<?php

namespace App\Services;

use App\Http\Controllers\HelperControler;
use App\Models\Project;


class ProjectService
{

    public function showAllProjects(){
        try {
            dd(Project::select('*')->with('user')->get());
            $projects = Project::select('*')->with('client')->orderBy('id', 'DESC')->paginate(15);
            return view('project.index')->with(['projects' => $projects]);
        }catch (\Exception $exception){
            echo $exception->getMessage();
        }
    }

    public function showFormForCreatingNewProject()
    {
        try {
            return view('project.show')->with([
                'clients' => HelperControler::getClientNamesWithIds(),
                'users' => HelperControler::getUserNamesWithIds()
            ]);
        } catch (\Exception $exception) {
            echo $exception->getMessage();
        }
    }

    public function createProject($request)
    {
        try {
            Project::create($request->validated());
            return redirect(route('project.index'))->with('success', 'New project have been created');
        } catch (\Exception $exception) {
            echo $exception->getMessage();
        }
    }

}
