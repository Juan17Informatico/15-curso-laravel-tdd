<?php

namespace Tests\Unit\Model;

use App\Models\User;
use Illuminate\Database\Eloquent\Collection;
use Tests\TestCase;

class UserTest extends TestCase
{
    /**
     * A basic unit test example.
     */
    public function testHasManyRepositories(): void
    {
        $user = new User();
        // dd($user->repositories)
        $this->assertInstanceOf(Collection::class, $user->repositories);
    }
}
