<?php

namespace App\Service\V1\Product;

use App\Repository\V1\Product\ProductRepository;

class ProductServiceDelete
{

    protected $productRepository;

    public function __construct(
        ProductRepository $ProductRepository
    )
    {
        $this->ProductRepository = $ProductRepository;
    }

    public function delete(int $id)
    {
        return $this->ProductRepository->delete($id);
    }

}