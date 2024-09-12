<?php

namespace Tests\Unit\Model;

use App\Models\Repository;
use App\Models\User;
use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase; 

class RepositoryTest extends TestCase
{
    use RefreshDatabase; 
    /**
     * A basic unit test example.
     */
    public function testBelongsToUser(): void
    {
        $repository = Repository::factory()->create();

        $this->assertInstanceOf(User::class, $repository->user);
    }
}
