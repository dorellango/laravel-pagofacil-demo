<?php

namespace Tests\Unit;

use App\Order;
use App\Product;
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

    /** @test */
    public function it_can_calculate_the_subtotal()
    {
        $product = factory(Product::class)->create(['price' => 10000]);
        $order = factory(Order::class)->create();

        $order->products()->attach($product, [
            'quantity' => 3,
            'price' => 10000
            ]);

        $this->assertEquals('30000', $order->fresh()->getSubtotal());
    }

    /** @test */
    public function it_has_a_path()
    {
        $order = factory(Order::class)->create();

        $this->assertEquals(
            $order->path(),
            route('orders.show', $order)
        );
    }
}
