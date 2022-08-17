<?php

namespace App\Service\V1\Product;

use Illuminate\Http\Request;
use App\Repository\V1\Product\ProductRepository;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Exceptions\HttpResponseException;
use Symfony\Component\HttpFoundation\Response;

class ProductServiceUpdate
{

    use Traits\RuleTrait;
    protected $productRepository;

    public function __construct(
        ProductRepository $productRepository
    )
    {
        $this->productRepository = $productRepository;
    }

    public function update(int $id, $request)
    {
        $attributes = $request;

        if (!$this->productRepository->show((int) $id)) {
            throw new HttpResponseException(response()->json([
                'errors' => "Product not found"
            ], Response::HTTP_NOT_FOUND));
        }

        $validator = Validator::make($attributes, $this->rules());

        if ($validator->fails()) {
            throw new HttpResponseException(response()->json([
                'errors' => $validator->errors()
            ], Response::HTTP_UNPROCESSABLE_ENTITY));
        }

        return $this->productRepository->update((int) $id, $attributes);
    }
}