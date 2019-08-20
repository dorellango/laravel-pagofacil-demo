<?php

namespace Tests\Feature;

use App\Order;
use App\Product;
use App\User;
use Darryldecode\Cart\Facades\CartFacade;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class ProcessOrderTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function can_process_a_order()
    {
        $user = factory(User::class)->create();
        $product = factory(Product::class)->create();

        CartFacade::session($user->id);
        CartFacade::add(
            $product->id,
            $product->name,
            $product->price,
            10
        );

        $this->actingAs($user)
        ->get('checkout/process');

        $this->assertDatabaseHas('orders', ['user_id' => $user->id]);

        $this->assertDatabaseHas('order_product', [
            'order_id' => Order::first()->id,
            'product_id' => $product->id,
            'quantity' => 10
        ]);
    }
}
