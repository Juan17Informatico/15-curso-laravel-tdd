<?php

namespace Tests\Feature\Http\Controllers;

use App\Models\Repository;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class RepositoryControllerTest extends TestCase
{
    use WithFaker, RefreshDatabase;

    public function testGuest(): void
    {
        $this->delete('repositories/1')->assertRedirect('login');   //destroy
        $this->get('repositories')->assertRedirect('login');        //index
        $this->get('repositories/1')->assertRedirect('login');      //show
        $this->get('repositories/1/edit')->assertRedirect('login'); //edit
        $this->get('repositories/create')->assertRedirect('login'); //create 
        $this->post('repositories/', [])->assertRedirect('login');  //store
        $this->put('repositories/1')->assertRedirect('login');      //update
    }

    public function testStore(): void
    {
        $data = [
            'url' => $this->faker->url,
            'description' => $this->faker->text,
        ]; 

        $user = User::factory()->create();

        $this
            ->actingAs($user)
            ->post('repositories', $data)
            ->assertRedirect('repositories');

        $this->assertDatabaseHas('repositories', $data);
    }

    public function testUpdate(): void
    {
        $repository = Repository::factory()->create(); 
        $data = [
            'url' => $this->faker->url,
            'description' => $this->faker->text,
        ]; 

        $user = User::factory()->create();

        $this
            ->actingAs($user)
            ->put("repositories/$repository->id", $data)
            ->assertRedirect("repositories/$repository->id/edit");

        $this->assertDatabaseHas('repositories', $data);
    }

}
