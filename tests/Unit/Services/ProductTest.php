<?php

namespace Tests\Unit\Services;

use App\Service\V1\Product\ProductServiceRegistration;
use App\Repository\V1\Product\ProductRepository;
use App\Models\Product;
use App\Service\V1\Product\ProductServiceUpdate;
use Illuminate\Support\Str;

use Tests\TestCase;

class ProductTest extends TestCase {

    protected function setUp(): void
    {
        parent::setUp();

        #Product::truncate();

        Product::insert([
            [
                'name' => "iPhone X",
                'price' => 3600,
                'description' => 'O Apple iPhone X é um smartphone iOS avançado e abrangente em todos os pontos de vista com algumas características excelentes.',
                'category' => 'Smartphone',
                'image_url' => 'https://imgs.extra.com.br/11823981/1xg.jpg?imwidth=500',
            ],
            [
                'name' => "iPhone XI",
                'price' => 4500,
                'description' => 'O Apple iPhone XI é um smartphone iOS avançado e abrangente em todos os pontos de vista com algumas características excelentes.',
                'category' => 'Smartphone',
                'image_url' => 'https://imgs.extra.com.br/11823981/1xg.jpg?imwidth=5000',
            ],
            [
                'name' => "iPhone XII",
                'price' => 6500,
                'description' => 'O Apple iPhone XII é um smartphone iOS avançado e abrangente em todos os pontos de vista com algumas características excelentes.',
                'category' => 'Smartphone',
                'image_url' => 'https://imgs.extra.com.br/11823981/1xg.jpg?imwidth=50000',
            ]
        ]);
    }


    /**
     * A  unit test for create product.
     *
     * @return void
     */
    use \App\Service\V1\Product\Traits\RuleTrait;
    use \Illuminate\Foundation\Testing\DatabaseTransactions;

    function test_create() {
        $attributes = [
            'name' => "iPhone Xs",
            'price' => 3600,
            'description' => 'O Apple iPhone Xs é um smartphone iOS avançado e abrangente em todos os pontos de vista com algumas características excelentes.',
            'category' => 'Smartphone',
            'image_url' => 'https://imgs.extra.com.br/11823981/1xg.jpg?imwidth=500',
        ];

        $ProductRepository = new ProductRepository(new Product());

        $productServiceRegistration = new ProductServiceRegistration(
                $ProductRepository
        );
        $product = $productServiceRegistration->store($attributes);
        $expcetedProductId = Product::find($product->id);
        $this->assertEquals($expcetedProductId->id, $product->id);
    }

    /**
     * A  unit test for update product.
     *
     * @return void
     */
    function test_update() {

        $attributes = [
            'name' => "iPhone Xs",
            'price' => 3600,
            'description' => 'O Apple iPhone Xs é um smartphone iOS avançado e abrangente em todos os pontos de vista com algumas características excelentes.',
            'category' => 'Smartphone',
            'image_url' => 'https://imgs.extra.com.br/11823981/1xg.jpg?imwidth=500',
        ];

        $attributesUpdate = [
            'name' => "iPhone XIII",
            'price' => 45,
            'description' => 'O Apple iPhone XI é um smartphone iOS avançado e abrangente em todos os pontos de vista com algumas características excelentes.',
            'category' => 'Smartphone',
            'image_url' => 'https://imgs.extra.com.br/11823981/1xg.jpg?imwidth=500',
        ];

        $ProductRepository = new ProductRepository(new Product());
        $productServiceRegistration = new ProductServiceRegistration(
            $ProductRepository
        );
        $product = $productServiceRegistration->store($attributes);

        $productServiceUpdate = new ProductServiceUpdate(
                $ProductRepository
        );
        $productUpdate = $productServiceUpdate->update($product->id, $attributesUpdate);

        if (!empty($productUpdate)) {
            $expcetedProductId = Product::find($productUpdate->id);
            $this->assertEquals($expcetedProductId->id, $productUpdate->id);
        }

    }

}