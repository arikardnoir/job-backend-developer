<?php

namespace App\Http\Controllers\V1;

use Illuminate\Http\Request;
use App\Service\V1\Product\ProductServiceRegistration;
use App\Service\V1\Product\ProductServiceShow;
use App\Http\Controllers\Controller;
use App\Service\V1\Product\ProductServiceUpdate;
use App\Service\V1\Product\ProductServiceDelete;
use App\Filters\V1\Product\ProductFilters;


class ProductController extends Controller
{

    protected $productServiceRegistration;
    protected $productServiceUpdate;
    protected $productServiceShow;
    protected $productServiceDelete;
    protected $productFilters;

    public function __construct(
        ProductServiceRegistration $productServiceRegistration,
        ProductServiceUpdate $productServiceUpdate,
        ProductServiceShow $productServiceShow,
        ProductServiceDelete $productServiceDelete,
        ProductFilters $productFilters

    ) {
        $this->productServiceRegistration = $productServiceRegistration;
        $this->productServiceUpdate = $productServiceUpdate;
        $this->productServiceShow = $productServiceShow;
        $this->productServiceDelete = $productServiceDelete;
        $this->productFilters = $productFilters;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $product = $this->productFilters->apply($request->all());
        return response()->json(['data' => $product]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $product = $this->productServiceRegistration->store($request->all());

        return response()->json(['data' => $product]);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $product = $this->productServiceShow->show($id);

        return response()->json(['data' => $product]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(int $id, Request $request)
    {
        $product = $this->productServiceUpdate->update($id, $request->all());

        return response()->json(['data' => $product]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        return $this->productServiceDelete->delete($id);
    }


}