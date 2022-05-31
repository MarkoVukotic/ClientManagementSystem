<?php

namespace Tests\Feature;

use App\Models\Project;
use App\Models\Task;
use \App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class TaskTest extends TestCase
{
    use RefreshDatabase;

    /**
     * @test
     */
    public function does_the_route_for_tasks_exist(){
        $this->withoutExceptionHandling();
        $response = $this->get('/task');
        $response->assertStatus(200);
    }

    /**
     * @test
     */
    public function does_it_create_new_task(){
        $this->withoutExceptionHandling();
        $user = User::factory()->create();
        $project = Project::factory()->create();


        $params = [
            'title' => 'Projekat 1',
            'status' => 'todo',
            'priority' => 'medium',
            'deadline' => '2022-05-17',
            'project_id' => $project->id,
            'assignee' => $user->id,
        ];

        $response = $this->post('/task', $params)->getContent();
        $response_decoded = json_decode($response, true);

        $this->assertDatabaseHas('task', $response_decoded['data']);

    }

    /**
     * @test
     */
    public function does_it_return_an_exception_when_some_of_the_params_are_missing_for_creating_the_task(){
        $this->withoutExceptionHandling();
        $user = User::factory()->create();
        $project = Project::factory()->create();

        $params = [
            'status' => 'todo',
            'priority' => 'medium',
            'deadline' => '2022-05-17',
            'project_id' => $project->id,
            'assignee' => $user->id,
        ];

        $this->expectExceptionMessage('The given data was invalid');
        $this->expectException('Illuminate\Validation\ValidationException');
        $this->post('/task', $params)->getContent();
    }

    /**
     * @test
     */
    public function does_it_edit_the_task()
    {
        $this->withoutExceptionHandling();
        $user = User::factory()->create();
        $project = Project::factory()->create();

        $old_task_data = Task::factory()->create(['id' => 1]);
        $params = [
            'id' => 1,
            'data' => [
                'title' => 'Projekat 1',
                'status' => 'todo',
                'priority' => 'medium',
                'deadline' => '2022-05-17',
                'project_id' => $project->id,
                'assignee' => $user->id,
            ]
        ];

        $response = $this->patch('/task/' . $old_task_data->id, $params)->getContent();
        $response_decoded = json_decode($response, true);

        $this->assertEquals('success', $response_decoded['status']);
        $this->assertDatabaseHas('task', $params['data']);
    }

    /**
     * @test
     */
    public function does_it_safe_delete_the_task()
    {
        $this->withoutExceptionHandling();
        $old_task_data = Task::factory()->create(['id' => 1]);
        $params = ['id' => 1,];

        $response = $this->delete('/task/' . $old_task_data->id, $params)->getContent();
        $response_decoded = json_decode($response, true);

        $this->assertEquals('success', $response_decoded['status']);
        $this->assertSoftDeleted('task');
    }

    /**
     * @test
     */
    public function does_it_get_the_soft_deletes_of_task()
    {
        $this->withoutExceptionHandling();
        $old_task_data = Task::factory()->create(['id' => 1]);
        $params = ['id' => 1,];

        $this->delete('/task/' . $old_task_data->id, $params);

        $response = $this->get('task/softDeleted')->getContent();
        $response_decoded = json_decode($response, true);

        $this->assertEquals('success', $response_decoded['status']);
        $this->assertEquals($params['id'], $response_decoded['data'][0]['id']);
    }

    /**
     * @test
     */
    public function does_it_force_delete_safe_deleted_tasks(){
        $this->withoutExceptionHandling();
        $old_task_data = Task::factory()->create(['id' => 1]);
        $params = ['id' => 1,];

        $this->delete('/task/' . $old_task_data->id, $params);

        $response = $this->get('task/forceDelete')->getContent();
        $response_decoded = json_decode($response, true);

        $this->assertEquals('success', $response_decoded['status']);
        $this->assertDatabaseMissing('task', $params);
    }

}
