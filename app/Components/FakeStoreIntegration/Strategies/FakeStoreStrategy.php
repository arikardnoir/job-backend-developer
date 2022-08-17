<?php

namespace App\Components\FakeStoreIntegration\Strategies;

use Exception;
use GuzzleHttp\Client;
use GuzzleHttp\Exception\ClientException;
use App\Components\FakeStoreIntegration\Contracts\FakeStoreInterface;
use App\Components\FakeStoreIntegration\Exceptions\FakeStoreException;

class FakeStoreStrategy implements FakeStoreInterface
{

    /**
     * @var Client
     */
    protected $client;

    /**
     * FakeStoreStrategy constructor.
     * @param Client $client
     */
    public function __construct(Client $client)
    {
        $this->client = $client;
    }

    /**
     * 
     *
     * @throws Exception
     */
    public function getProducts(
    )
    {
        try {
                
            $response = $this->client->request('GET', '/products?limit=10');
            return json_decode($response->getBody()->getContents());
        } catch (ClientException $exception) {
            $response = json_decode($exception->getResponse()->getBody()->getContents());

            throw new FakeStoreException(
            $response->message, $exception->getCode()
            );
        } catch (Exception $exception) {
            throw $exception;
        }
    }

    /**
     * @param int $id
     * @return Object
     * @throws Exception
     */
    public function getProduct(
    int $id
    ): Object
    {
        try {
            $response = $this->client->request('GET', '/products/'.$id);
            return json_decode($response->getBody()->getContents());
        } catch (ClientException $exception) {
            $response = json_decode($exception->getResponse()->getBody()->getContents());
            throw new FakeStoreException(
            $response->message, $exception->getCode()
            );
        } catch (Exception $exception) {
            throw $exception;
        }
    }

}