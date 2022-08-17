<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Components\FakeStoreIntegration\Client as ClientAuthorization;
use App\Models\Product;
use App\Repository\V1\Product\ProductRepository;
use App\Service\V1\Product\ProductServiceRegistration;

class ImportProduct extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'products:import {--id=}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Import product from another API and insert into the database.';

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        $id = $this->option('id');

        if (empty($id)) {
            $products = app(ClientAuthorization::class)->getProducts();
            foreach ($products as $product){
                (new ProductServiceRegistration(new ProductRepository(new Product)))->store([
                    "name" => $product->title,
                    "price" => $product->price,
                    "description" => $product->description,
                    "category" => $product->category,
                    "image_url" => $product->image,
                ]);
            }
        }else{
            $product = app(ClientAuthorization::class)->getProduct($id);
            (new ProductServiceRegistration(new ProductRepository(new Product)))->store([
                "name" => $product->title,
                "price" => $product->price,
                "description" => $product->description,
                "category" => $product->category,
                "image_url" => $product->image,
            ]);
        }
    }
}
