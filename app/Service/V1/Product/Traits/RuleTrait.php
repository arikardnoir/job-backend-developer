<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of RuleTrait
 *
 * @author arikardnoir
 */

namespace App\Service\V1\Product\Traits;
trait RuleTrait
{

    public function rules()
    {
        return [
            'name' => 'required|string|max:500|unique:products',
            'price' => 'required|numeric',
            'description' => 'required|string|max:5000',
            'category' => 'required|string|max:255',
            'image_url' => 'max:5000',
        ];
    }
}