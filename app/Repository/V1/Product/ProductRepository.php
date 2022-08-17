<?php

namespace App\Repository\V1\Product;

use App\Models\Product;
use App\Repository\V1\BaseRepository;
use Illuminate\Support\Facades\DB;

class ProductRepository extends BaseRepository
{

    public function __construct(Product $product)
    {
        parent::__construct($product);
    }

    public function all($searchQuery = null, $category = null, $hasImage = null): object
    {
        if ($searchQuery) {

            return $this->obj->where('name', 'like', '%' . $searchQuery . '%')
                            ->orWhere('category', 'like', '%' . $searchQuery . '%')
                            ->paginate(10);
        }

        if ($category) {

            return $this->obj->where('category', $category)
                            ->paginate(10);
        }

        #Find better to write this code
        if ($hasImage == "true") {

            return $this->obj->where('image_url', '<>', null)
                            ->paginate(10);
        }

        if ($hasImage == "false") {

            return $this->obj->where('image_url', '=', null)
                            ->paginate(10);
        }

        return $this->obj->paginate(10);
    }
    
    public function save(array $attributes): object
    {
        DB::beginTransaction();
        try {
            $product = $this->obj->create($attributes);
            DB::commit();
            return $product->where('id', $product->id)
                   ->first();
        } catch (Exception $ex) {
            DB::rollback();
            return $ex->getMessage();
        }
    }

    public function update(int $id, array $attributes): object
    {
        DB::beginTransaction();
        try {
            $product = $this->obj->find($id);
            if ($product) {
                $product = $product->updateOrCreate([
                    'id' => $id,
                        ], $attributes);

                DB::commit();
                return $this->obj->find($product->id)->first();
            }

            return (object) $product;
            
        } catch (Exception $ex) {
            DB::rollback();
            return $ex->getMessage();
        }
    }

    public function show(int $id): object
    {
        try {
            $product = $this->obj->find($id);
            if ($product) {
                return $this->obj->find($id)->first();
            }
    
            return (object) $product;
        } catch (Exception $ex) {
            DB::rollback();
            return $ex->getMessage();
        }

    }

    public function delete($id): bool
    {
        return $this->obj->destroy($id);
    }

}