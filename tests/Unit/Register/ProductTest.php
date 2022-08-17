<?php

namespace Tests\Unit\Register;

use App\Models\Product;
use Tests\TestCase;

class UserTest extends TestCase {

    /**
     * A unit test for creates product.
     *
     * @return void
     */
    use \App\Service\V1\Product\Traits\RuleTrait;
    use \Illuminate\Foundation\Testing\DatabaseTransactions;

    function test_create() {


        $product = \App\Models\Product::factory()->create();

        $expcetedProductId = Product::find($product->id);
        $this->assertEquals($expcetedProductId->id, $product->id);
    }
}