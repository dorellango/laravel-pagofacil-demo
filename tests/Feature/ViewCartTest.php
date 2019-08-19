<?php

namespace Tests\Feature;

use App\Product;
use App\User;
use Darryldecode\Cart\Facades\CartFacade;
use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;

class ViewCartTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function can_view_the_items_on_his_cart()
    {
        $user = factory(User::class)->create();
        $product = factory(Product::class)->create();

        CartFacade::session($user->id)
        ->add(
            $product->id,
            $product->name,
            $product->price,
            10
        );

        $this->actingAs($user)
            ->get('/cart')
            ->assertViewIs('cart.show')
            ->assertViewHas('products', function ($products) use ($product) {
                return $products->toArray()[1]['name'] === $product->name;
            });
    }

    /** @test */
    public function can_only_view_the_items_on_his_cart()
    {
        $user = factory(User::class)->create();
        $anyone = factory(User::class)->create();
        $product = factory(Product::class)->create();

        CartFacade::session($anyone->id)
        ->add(
            $product->id,
            $product->name,
            $product->price,
            10
        );

        $this->actingAs($user)
            ->get('/cart')
            ->assertViewIs('cart.show')
            ->assertViewHas('products', function ($products) {
                return $products->isEmpty();
            });
    }
}
