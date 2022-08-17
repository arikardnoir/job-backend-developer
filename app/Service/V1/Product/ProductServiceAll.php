<?php

namespace App\Service\V1\Product;

use App\Repository\V1\Product\ProductRepository;

class ProductServiceAll
{

    protected $productRepository;

    public function __construct(
        ProductRepository $productRepository
    )
    {
        $this->productRepository = $productRepository;
    }

    public function all($searchQuery = null, $category = null, $hasImage = null)
    {
        return $this->productRepository->all($searchQuery, $category, $hasImage);
    }

}