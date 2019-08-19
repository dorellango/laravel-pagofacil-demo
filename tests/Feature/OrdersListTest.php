<?php

namespace Tests\Feature;

use App\Order;
use App\User;
use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;

class OrdersListTest extends TestCase
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
}
