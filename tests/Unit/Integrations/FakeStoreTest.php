<?php

namespace Tests\Unit\Integrations;

use App\Components\FakeStoreIntegration\Client as ClientAuthorization;
use Tests\TestCase;

class FakeStoreTest extends TestCase {

    /**
     * Test to get products.
     *
     * @return void
     */
    function test_get_products() {
        $expceted=app(ClientAuthorization::class)->getProducts();        
        $this->assertEquals(count($expceted), 10);
        
    }

    /**
     * test to get specific product.
     *
     * @return void
     */
    function test_get_product() {
        $idProduct=3;
        $expceted=app(ClientAuthorization::class)->getProduct($idProduct);        
        $this->assertEquals($expceted->title, "Mens Cotton Jacket");
    }

}