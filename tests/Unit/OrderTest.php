<?php

namespace Tests\Unit;

use App\Order;
use App\User;
use Illuminate\Database\Eloquent\Collection;
use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;

class OrderTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function it_belongs_to_a_user()
    {
        $order = factory(Order::class)->create();

        $this->assertInstanceOf(User::class, $order->owner);
    }

    /** @test */
    public function it_has_many_products()
    {
        $order = factory(Order::class)->create();

        $this->assertInstanceOf(Collection::class, $order->products);
    }
}
