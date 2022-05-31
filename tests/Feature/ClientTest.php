<?php

namespace Tests\Unit;

use App\Models\Client;
use App\Models\Project;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Session;
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
        Client::factory(15)->create([
            'first_name' => 'First Name'
        ]);

        $response = $this->get('/client');

        $response->assertStatus(200);
        $response->assertViewIs('client.index');
        $response->assertViewHas('clients');
        $response->assertSee('First Name');
    }

    /**
     * @test
     */
    public function does_it_create_new_client()
    {
        $this->withoutExceptionHandling();
        $params = [
            'first_name' => 'Marko',
            'last_name' => 'Vukotic',
            'email' => 'markovukotic@test.com',
            'country' => 'Montenegro',
            'priority' => 'low',
        ];

        $response = $this->post('/client', $params);

        $response->assertStatus(302);
        $response->assertRedirect('/client');
        $this->assertTrue(Session::has('success'));
        $this->assertEquals("New client have been created", Session::get('success'));
        $this->assertDatabaseHas('clients', $params);
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
            'first_name' => 'Marko Updated',
            'last_name' => 'Vukotic',
            'email' => 'markovukotic@test.com',
            'country' => 'Montenegro',
            'priority' => 'low',
        ];

        $response = $this->patch('client/' . $old_client_data->id, $params);

        $response->assertStatus(302);
        $response->assertRedirect('/client');
        $this->assertTrue(Session::has('success'));
        $this->assertEquals("Client have been successfully updated", Session::get('success'));
        $this->assertDatabaseHas('clients', $params);
    }

    /**
     * @test
     */
    public function does_it_safe_delete_the_client()
    {
        $this->withoutExceptionHandling();
        $old_client_data = Client::factory()->create(['id' => 1]);
        $params = ['id' => 1,];

        $response = $this->delete('/client/' . $old_client_data->id, $params);

        $response->assertStatus(302);
        $response->assertRedirect('/client');
        $this->assertTrue(Session::has('success'));
        $this->assertEquals("Client have been successfully deleted", Session::get('success'));
        $this->assertSoftDeleted('clients', $params);
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