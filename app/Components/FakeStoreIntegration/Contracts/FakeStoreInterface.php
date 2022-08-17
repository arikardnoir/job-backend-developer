<?php

namespace App\Components\FakeStoreIntegration\Contracts;

interface FakeStoreInterface
{

    /**
     * 
     * @return Array
     */
    public function getProducts();


    /**
     * @param int $id
     * @return Object
     */
    public function getProduct(
        int $id
    ): Object;
}