<?php

namespace App\Service\V1\Product;

use App\Repository\V1\Product\ProductRepository;
use Illuminate\Http\Exceptions\HttpResponseException;
use Symfony\Component\HttpFoundation\Response;

class ProductServiceShow
{

    protected $productRepository;

    public function __construct(
        ProductRepository $productRepository
    )
    {
        $this->productRepository = $productRepository;
    }

    public function show(int $id)
    {
        if (!$this->productRepository->show((int) $id)) {
            throw new HttpResponseException(response()->json([
                'errors' => "Product not found"
            ], Response::HTTP_NOT_FOUND));
        }

        return $this->productRepository->show($id);
    }

}