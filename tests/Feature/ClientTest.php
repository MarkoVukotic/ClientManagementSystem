<?php

namespace Tests\Unit;

use App\Models\Client;
use App\Models\Project;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class ClientTest extends TestCase
{
    use RefreshDatabase;

    /**
     * @test
     */
    public function does_the_route_for_client_exist()
    {
        $this->withoutExceptionHandling();
        $response = $this->get('/client');
        $response->assertStatus(200);
    }

    /**
     * @test
     */
    public function does_it_return_all_the_clients_there_are_in_the_database()
    {
        $this->withoutExceptionHandling();
        Client::factory(5)->create();

        $response = $this->get('/client')->getContent();
        $decoded_response = json_decode($response, true);

        $this->assertEquals(5, sizeof($decoded_response['data']));
    }

    /**
     * @test
     */
    public function does_it_create_new_client()
    {
        $this->withoutExceptionHandling();
        $project = Project::factory()->create();

        $params = [
            'first_name' => 'Marko',
            'last_name' => 'Vukotic',
            'email' => 'markovukotic@test.com',
            'country' => 'Montenegro',
            'priority' => 'low',
        ];

        $response = $this->post('/client', $params)->getContent();
        $response_decoded = json_decode($response, true);

        $this->assertDatabaseHas('clients', $response_decoded['data']);

    }

    /**
     * @test
     */
    public function does_it_return_an_exception_when_some_of_the_params_are_missing_for_creating_the_client()
    {
        $this->withoutExceptionHandling();
        $params = [
            'last_name' => 'Vukotic',
            'email' => 'markovukotic@test.com',
            'country' => 'Montenegro',
            'priority' => 'low',
        ];

        $this->expectExceptionMessage('The given data was invalid');
        $this->expectException('Illuminate\Validation\ValidationException');
        $this->post('/client', $params)->getContent();
    }

    /**
     * @test
     */
    public function does_it_edit_the_client()
    {
        $this->withoutExceptionHandling();
        $old_client_data = Client::factory()->create(['id' => 1]);
        $params = [
            'id' => 1,
            'data' => [
                'first_name' => 'Marko',
                'last_name' => 'Vukotic',
                'email' => 'markovukotic@test.com',
                'country' => 'Montenegro',
                'priority' => 'low',
            ]
        ];

        $response = $this->patch('/client/' . $old_client_data->id, $params)->getContent();
        $response_decoded = json_decode($response, true);

        $this->assertEquals('success', $response_decoded['status']);
        $this->assertDatabaseHas('clients', $params['data']);
    }

    /**
     * @test
     */
    public function does_it_safe_delete_the_client()
    {
        $this->withoutExceptionHandling();
        $old_client_data = Client::factory()->create(['id' => 1]);
        $params = ['id' => 1,];

        $response = $this->delete('/client/' . $old_client_data->id, $params)->getContent();
        $response_decoded = json_decode($response, true);

        $this->assertEquals('success', $response_decoded['status']);
        $this->assertSoftDeleted('client');
    }

    /**
     * @test
     */
    public function does_it_get_the_soft_deletes_of_clients()
    {
        $this->withoutExceptionHandling();
        $old_client_data = Client::factory()->create(['id' => 1]);
        $params = ['id' => 1,];

        $this->delete('/client/' . $old_client_data->id, $params);

        $response = $this->get('client/softDeleted')->getContent();
        $response_decoded = json_decode($response, true);
        $this->assertEquals('success', $response_decoded['status']);
        $this->assertEquals($params['id'], $response_decoded['data'][0]['id']);
    }

    /**
     * @test
     */
    public function does_it_force_delete_safe_deleted_clients()
    {
        $this->withoutExceptionHandling();
        $old_client_data = Client::factory()->create(['id' => 1]);
        $params = ['id' => 1,];

        $this->delete('/client/' . $old_client_data->id, $params);

        $response = $this->get('client/forceDelete')->getContent();
        $response_decoded = json_decode($response, true);

        $this->assertEquals('success', $response_decoded['status']);
        $this->assertDatabaseMissing('clients', $params);
    }
}
