<?php

namespace Tests\Feature;

use App\Product;
use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;

class ViewStoreTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function can_view_the_store_front_page()
    {
        $product = factory(Product::class)->create();

        $this->get('/')
        ->assertViewIs('welcome')
        ->assertViewHas('products', function ($products) use ($product) {
            return $products->contains($product);
        });
    }
}
