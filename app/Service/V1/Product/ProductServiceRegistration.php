<?php

namespace App\Service\V1\Product;

use App\Repository\V1\Product\ProductRepository;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Exceptions\HttpResponseException;
use Symfony\Component\HttpFoundation\Response;

class ProductServiceRegistration
{

    use Traits\RuleTrait;
    protected $productRepository;

    public function __construct(
        ProductRepository $productRepository
    )
    {
        $this->productRepository = $productRepository;
    }

    public function store($request)
    {
        $attributes = $request;
        
        $validator = Validator::make($attributes, $this->rules());

        if ($validator->fails()) {
            throw new HttpResponseException(response()->json([
                'errors' => $validator->errors()
            ], Response::HTTP_UNPROCESSABLE_ENTITY));
        }

        $product = $this->productRepository->save($attributes);
        return $product?$product:'unidentified product';
    }

}