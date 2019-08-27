<?php

namespace Tests\Feature;

use App\Order;
use App\User;
use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;

class ReadOrderTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function can_view_all_the_orders()
    {
        $order = factory(Order::class)->create();

        $user = factory(User::class)->create();

        $this->actingAs($user)
        ->get('orders')
        ->assertViewIs('orders.index')
        ->assertViewHas('orders', function ($orders) use ($order) {
            return $orders->contains($order);
        });
    }

    /** @test */
    public function it_can_view_a_single_order()
    {
        $order = factory(Order::class)->create();

        $user = factory(User::class)->create();

        $this->actingAs($user)
        ->get($order->path())
        ->assertViewIs('orders.show')
        ->assertViewHas('order', function ($viewable) use ($order) {
            return $viewable->is($order);
        });
    }
}
