<?php

namespace Tests\Feature;

use App\Product;
use App\User;
use Darryldecode\Cart\Facades\CartFacade;
use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;

class ManageCartTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function can_add_products_to_cart()
    {
        $user = factory(User::class)->create();
        $product = factory(Product::class)->create();

        $this->actingAs($user)
        ->get("cart/$product->id/add")
        ->assertStatus(302);

        $this->assertFalse(CartFacade::isEmpty());
        $this->assertContains(
            $product->name,
         CartFacade::getContent()->toArray()[1]
        );
    }

    /** @test */
    public function can_remove_products_from_a_cart()
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

        $this->assertFalse(CartFacade::isEmpty());

        $this->actingAs($user)
        ->get("cart/$product->id/remove")
        ->assertRedirect('/cart');

        $this->assertTrue(CartFacade::isEmpty());
    }
}
