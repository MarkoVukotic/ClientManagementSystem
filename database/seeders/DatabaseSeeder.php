<?php

namespace Database\Seeders;

use App\Models\Client;
use App\Models\Project;
use App\Models\Task;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        Client::factory(5)->create();
        Project::factory(5)->create();
        Task::factory(10)->create();

        DB::table('users')->insert([
            'name' => 'Marko',
            'email' => 'markovukotic32@gmail.com',
            'email_verified_at' => now(),
            'password' => bcrypt('marko123'),
            'remember_token' => Str::random(10),
        ]);
    }
}
