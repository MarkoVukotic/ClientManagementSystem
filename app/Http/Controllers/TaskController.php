<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreTaskRequest;
use App\Models\Task;
use Illuminate\Http\Request;

class TaskController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreTaskRequest $request)
    {
        try {
            $new_task = Task::create($request->validated());
            return output($new_task);
        }catch(\Exception $exception){
            echo $exception->getMessage();
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Task  $task
     * @return \Illuminate\Http\Response
     */
    public function show(Task $task)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Task  $task
     * @return \Illuminate\Http\Response
     */
    public function edit(Task $task)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Task  $task
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Task $task)
    {
        try {
            $data = $request->get('data');

            $update_task = $task->update([
                'title' => $data['title'],
                'status' => $data['status'],
                'priority' => $data['priority'],
                'deadline' => $data['deadline'],
                'project_id' => $data['project_id'],
                'assignee' => $data['assignee'],
            ]);
            return output($update_task);

        } catch (\Exception $exception) {
            echo $exception->getMessage();
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Task  $task
     * @return \Illuminate\Http\Response
     */
    public function destroy(Task $task)
    {
        $delete_task = $task->delete();
        return output($delete_task);
    }

    public function softDeletedTasks()
    {
        try {
            $soft_deleted_tasks = Task::withTrashed()->where('id', 1)->get();
            return output($soft_deleted_tasks);

        } catch (\Exception $exception) {
            echo $exception->getMessage();
        }
    }

    public function forceDeleteSoftDeletedTasks()
    {
        try {
            $force_deleted_tasks = Task::withTrashed()->where('id', 1)->forceDelete();
            return output($force_deleted_tasks);

        } catch (\Exception $exception) {
            echo $exception->getMessage();
        }
    }
}
