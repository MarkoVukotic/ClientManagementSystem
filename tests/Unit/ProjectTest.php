<?php

namespace Tests\Unit;

use App\Models\Client;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

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
            $user = \App\Models\User::factory()->create();
            $client = Client::factory()->create();

            $params = [
                'title' => 'Projekat 1',
                'description' => 'Projekat 1 i njegov opis je veoma jednostavan',
                'deadline' => date(now()),
                'status' => 'open',
                'assigned_user' => $user->id,
                'assigned_client' => $client->id,
            ];

            $response = $this->post('/project', $params)->getContent();
            dd($response);

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


}
