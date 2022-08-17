<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of ProductFilters
 *
 * @author arikardnoir
 */

namespace App\Filters\V1\Product;

use App\Service\V1\Product\ProductServiceAll;

class ProductFilters
{

    private $searchQuery;
    private $category;
    private $hasImage;
    private $productServiceAll;

    public function __construct(
        ProductServiceAll $productServiceAll
    )
    {
        $this->productServiceAll = $productServiceAll;
    }

    public function apply($request)
    {
        if (!empty($request['searchQuery'])) {
            $this->searchQuery = $request['searchQuery'];
        }
        
        if (!empty($request['category'])) {
            $this->category = $request['category'];
        }

        if (!empty($request['hasImage'])) {
            $this->hasImage = $request['hasImage'];
        }
        return $this->productServiceAll->all($this->searchQuery, $this->category, $this->hasImage);
    }

}