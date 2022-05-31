<?php

namespace Tests\Unit;

use App\Models\Client;
use App\Models\Project;
use Illuminate\Foundation\Testing\RefreshDatabase;
use \Illuminate\Support\Facades\Session;
use Tests\TestCase;
use \App\Models\User;

class ProjectTest extends TestCase
{
    use RefreshDatabase;

    /**
     * @test
     */
    public function does_the_route_for_project_exist(){
        $this->withoutExceptionHandling();
        $response = $this->get('/project');
        $response->assertStatus(200);
    }

    /**
     * @test
     */
        public function does_it_create_new_project(){
            $this->withoutExceptionHandling();
            $user = User::factory()->create();
            $client = Client::factory()->create();

            $params = [
                'title' => 'Projekat 1',
                'description' => 'Projekat 1 i njegov opis je veoma jednostavan',
                'deadline' => '2022-05-17',
                'status' => 'open',
                'assigned_user' => $user->id,
                'client_id' => $client->id,
            ];

            $response = $this->post('/project', $params);

            $response->assertRedirect();
            $this->assertTrue(Session::has('success'));
            $this->assertEquals("New project have been created", Session::get('success'));
            $this->assertDatabaseHas('projects', $params);
        }

        /**
         * @test
         */
        public function does_it_return_an_exception_when_some_of_the_params_are_missing_for_creating_the_project(){
            $this->withoutExceptionHandling();
            $params = [
                'description' => 'Projekat 1 i njegov opis je veoma jednostavan',
                'deadline' => date(now()),
                'status' => 'Open',
                'assigned_user' => 1,
                'assigned_client' => 1,
            ];

            $this->expectExceptionMessage('The given data was invalid');
            $this->expectException('Illuminate\Validation\ValidationException');
            $this->post('/project', $params)->getContent();
        }

    /**
     * @test
     */
    public function does_it_edit_the_project()
    {
        $this->withoutExceptionHandling();
        $user = User::factory()->create();
        $client = Client::factory()->create();
        $old_project_data = Project::factory()->create(['id' => 1]);
        $params = [
            'id' => 1,
            'data' => [
                'title' => 'Projekat 1',
                'description' => 'Projekat 1 i njegov opis je veoma jednostavan',
                'deadline' => '2022-05-17',
                'status' => 'open',
                'assigned_user' => $user->id,
                'client_id' => $client->id,
            ]
        ];

        $response = $this->patch('/project/' . $old_project_data->id, $params)->getContent();
        $response_decoded = json_decode($response, true);

        $this->assertEquals('success', $response_decoded['status']);
        $this->assertDatabaseHas('projects', $params['data']);
    }

    /**
     * @test
     */
    public function does_it_safe_delete_the_project()
    {
        $this->withoutExceptionHandling();
        $old_project_data = Project::factory()->create(['id' => 1]);
        $params = ['id' => 1,];

        $response = $this->delete('/project/' . $old_project_data->id, $params)->getContent();
        $response_decoded = json_decode($response, true);

        $this->assertEquals('success', $response_decoded['status']);
        $this->assertSoftDeleted('projects');
    }

    /**
     * @test
     */
    public function does_it_get_the_soft_deletes_of_projects()
    {
        $this->withoutExceptionHandling();
        $old_project_data = Project::factory()->create(['id' => 1]);
        $params = ['id' => 1,];

        $this->delete('/project/' . $old_project_data->id, $params);

        $response = $this->get('project/softDeleted')->getContent();
        $response_decoded = json_decode($response, true);

        $this->assertEquals('success', $response_decoded['status']);
        $this->assertEquals($params['id'], $response_decoded['data'][0]['id']);
    }

    /**
     * @test
     */
    public function does_it_force_delete_safe_deleted_projects(){
        $this->withoutExceptionHandling();
        $old_project_data = Project::factory()->create(['id' => 1]);
        $params = ['id' => 1,];

        $this->delete('/project/' . $old_project_data->id, $params);

        $response = $this->get('project/forceDelete')->getContent();
        $response_decoded = json_decode($response, true);

        $this->assertEquals('success', $response_decoded['status']);
        $this->assertDatabaseMissing('projects', $params);
    }

}
