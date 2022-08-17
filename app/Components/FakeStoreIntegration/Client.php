<?php
namespace App\Components\FakeStoreIntegration;
use Exception;
use App\Components\FakeStoreIntegration\Contracts\FakeStoreInterface;
use App\Components\FakeStoreIntegration\Exceptions\FakeStoreException;

class Client
{
    /**
     * @var fakeStoreInterface
     */
    protected $fakeStoreInterface;

    /**
     * Client constructor.
     * @param FakeStoreInterface $fakeStoreInterface
     */
    public function __construct(FakeStoreInterface $fakeStoreInterface)
    {
        $this->fakeStoreInterface = $fakeStoreInterface;
    }

    /**
     * 
     * @return Array
     * @throws FakeStoreException
     */
    public function getProducts(
    ): Array {
        try {
            return $this->fakeStoreInterface->getProducts();
        } catch (Exception $exception) {
            throw new FakeStoreException(
                $exception->getMessage(),
                $exception->getCode()
            );
        }
    }

    /**
     * @param int $id
     * @return Object
     * @throws FakeStoreException
     */
    public function getProduct(
        int $id
    ): Object {
        try {
            return $this->fakeStoreInterface->getProduct(
                $id
            );
        } catch (Exception $exception) {
            throw new FakeStoreException(
                $exception->getMessage(),
                $exception->getCode()
            );
        }
    }
}