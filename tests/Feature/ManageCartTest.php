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
        ->post("cart/$product->id/add", ['quantity' => 10])
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
        ->post("cart/$product->id/remove")
        ->assertStatus(302);

        $this->assertTrue(CartFacade::isEmpty());
    }

    /** @test */
    public function it_require_a_quantity()
    {
        $user = factory(User::class)->create();
        $product = factory(Product::class)->create();

        $this->actingAs($user)
        ->post("cart/$product->id/add")
        ->assertSessionHasErrors('quantity');
    }
}
