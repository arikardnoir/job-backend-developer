<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use GuzzleHttp\Client as GuzzleClient;
use App\Components\FakeStoreIntegration\Client;
use App\Components\FakeStoreIntegration\Strategies\FakeStoreStrategy;

class FakeStoreProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {        
        $this->app->singleton(Client::class, function () {
            $config = config('fakestore');
            $client = new GuzzleClient([
                'base_uri' => $config['base_uri'],
            ]);
             
            return new Client(new FakeStoreStrategy($client));
        });
    }

    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        //
    }
}