<?php

namespace Tests\Feature;

use Symfony\Component\HttpFoundation\Response;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class ProductTest extends TestCase
{

    use RefreshDatabase;
    use WithFaker;

    /**
     * Test to get all products
     *
     * @return void
     */
    public function test_get_all_products()
    {
        $response = $this->get('/api/products');

        $response->assertStatus(Response::HTTP_OK);
    }

    /**
     * Test to store product success
     *
     * @return void
     */
    public function test_store_product_success()
    {
        $response = $this->post('/api/products', [
            'name' => "Biodermas",
            'price' => 160,
            'description' => 'Bioderma é uma marca francesa de dermocosméticos, que une os conceitos da dermatologia e da biologia para cuidados com a pele.',
            'category' => 'Beauty',
            'image_url' => 'https://epocacosmeticos.vteximg.com.br/arquivos/ids/476885/atoderm-gel-douche-bioderma-hidratante-em-creme-500ml--1-.jpg?v=637807906068170000',
        ]);

        $response->assertStatus(Response::HTTP_OK);
    }

    /**
     * Test to get specififc product
     *
     * @return void
     */
    public function test_get_product()
    {
        $response = $this->get('/api/products/' . '1');

        $response->assertStatus(Response::HTTP_OK);
    }

    /**
     * Test to validate required  fields
     *
     * @return void
     */
    public function test_store_product_validate_required_fields()
    {
        $response = $this->post('/api/products', [
            'name' => "",
            'description' => '',
            'category' => '',
            'image_url' => 'https://epocacosmeticos.vteximg.com.br/arquivos/ids/476885/atoderm-gel-douche-bioderma-hidratante-em-creme-500ml--1-.jpg?v=637807906068170000'
        ],["Content-Type"=>"application/json"]);

        $response->assertStatus(Response::HTTP_UNPROCESSABLE_ENTITY);
        
    }

    /**
     * Test to validate unique field
     *
     * @return void
     */
    public function test_store_product_validate_unique_field()
    {
        $response = $this->post('/api/products', [
            'name' => "Bioderma",
            'price' => 50,
            'description' => 'Apple Inc. é uma empresa multinacional norte-americana que tem o objetivo de projetar e comercializar produtos eletrônicos de consumo, software de computador e computadores pessoais.',
            'category' => 'Technologies',
            'image_url' => 'https://pt.wikipedia.org/wiki/Apple'
        ],["Content-Type"=>"application/json"]);

        $response->assertStatus(Response::HTTP_UNPROCESSABLE_ENTITY);

    }

    /**
     * Test to validate numeric field
     *
     * @return void
     */
    public function test_store_product_validate_numeric_field()
    {
        $response = $this->post('/api/products', [
            'name' => "Apple Inc.",
            'price' => "50",
            'description' => 'Apple Inc. é uma empresa multinacional norte-americana que tem o objetivo de projetar e comercializar produtos eletrônicos de consumo, software de computador e computadores pessoais.',
            'category' => 'Technologies',
            'image_url' => 'https://pt.wikipedia.org/wiki/Apple'
        ],["Content-Type"=>"application/json"]);

        $response->assertStatus(Response::HTTP_UNPROCESSABLE_ENTITY);

    }

    /**
     * Test to validate string fields
     *
     * @return void
     */
    public function test_store_product_validate_string_fields()
    {
        $response = $this->post('/api/products', [
            'name' => 0,
            'price' => 100,
            'description' => 10,
            'category' => 10,
            'image_url' => 0
        ],["Content-Type"=>"application/json"]);

        $response->assertStatus(Response::HTTP_UNPROCESSABLE_ENTITY);

    }

    /**
     * Test to update product success
     *
     * @return void
     */
    public function test_update_product_success()
    {
        $response = $this->put('/api/products/2', [
            'name' => "Biodermas",
            'price' => 250,
            'description' => 'Bioderma é uma marca francesa de dermocosméticos, que une os conceitos da dermatologia e da biologia para cuidados com a pele.',
            'category' => 'Beauty Store',
            'image_url' => 'https://epocacosmeticos.vteximg.com.br/arquivos/ids/476885/atoderm-gel-douche-bioderma-hidratante-em-creme-500ml--1-.jpg?v=637807906068170000s'
        ]);

        $response->assertStatus(Response::HTTP_OK);
    }

        /**
     * Test to delete product success
     *
     * @return void
     */
    public function test_delete_product_success()
    {
        $response = $this->get('/api/products/delete/1');

        $response->assertStatus(Response::HTTP_OK);
    }
}
