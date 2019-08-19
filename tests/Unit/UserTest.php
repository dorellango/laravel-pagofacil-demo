<?php

namespace Tests\Unit;

use App\User;
use Illuminate\Database\Eloquent\Collection;
use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;

class UserTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function it_has_many_orders()
    {
        $user = factory(User::class)->create();

        $this->assertInstanceOf(Collection::class, $user->orders);
    }
}
