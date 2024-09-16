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
        $user = User::factory()->create();
        $repository = Repository::factory()->create(['user_id' => $user->id]); 
        $data = [
            'url' => $this->faker->url,
            'description' => $this->faker->text,
        ]; 



        $this
            ->actingAs($user)
            ->put("repositories/$repository->id", $data)
            ->assertRedirect("repositories/$repository->id/edit");

        $this->assertDatabaseHas('repositories', $data);
    }

    /********/

    public function testValidateStore(): void
    {
        $user = User::factory()->create();

        $this
            ->actingAs($user)
            ->post('repositories', [])
            ->assertStatus(302)
            ->assertSessionHasErrors(['url'], 'description');

    }

    public function testValidateUpdate(): void
    {
        $repository = Repository::factory()->create(); 
        $user = User::factory()->create();

        $this
            ->actingAs($user)
            ->put("repositories/$repository->id")
            ->assertStatus(302)
            ->assertSessionHasErrors(['url'], 'description');
    }

    public function testDestroy(): void
    {
        $repository = Repository::factory()->create(); 

        $user = User::factory()->create();

        $this
            ->actingAs($user)
            ->delete("repositories/$repository->id")
            ->assertRedirect("repositories");

        $this->assertDatabaseMissing('repositories', $repository->toArray());
    }

    public function testUpdatePolicy(): void
    {
        $user = User::factory()->create(); /// id = 1
        $repository = Repository::factory()->create();  // user_id = 2

        $data = [
            'url' => $this->faker->url,
            'description' => $this->faker->text,
        ];

        $this
            ->actingAs($user)
            ->put("repositories/$repository->id", $data)
            ->assertStatus(403);

    }

}
