<?php

namespace Tests\Unit;

use App\Product;
use Illuminate\Database\Eloquent\Collection;
use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;

class ProductTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function it_belongs_to_many_orders()
    {
        $product = factory(Product::class)->create();

        $this->assertInstanceOf(Collection::class, $product->orders);
    }
}
