<?php
declare(strict_types = 1);

namespace Iaejean\Store;

use Ding\Logger\ILoggerAware;
use Iaejean\Base\TraitLoggerAware;
use Iaejean\Product\Product;

/**
 * Class StoreService
 * @package Iaejean\Store
 * @Component(name=store_service)
 * @Singleton
 */
class StoreService implements ILoggerAware
{
    /**
     * @var StoreDao
     * @Resource(name=store_dao)
     */
    private $storeDao;
    use TraitLoggerAware;

    /**
     * @return array
     */
    public function findAll(): array
    {
        return $this->storeDao->findAll();
    }

    /**
     * @param Store $store
     * @param Product $product
     * @return Product
     * @throws \Exception
     */
    public function findProductBy(Store $store, Product $product): Product
    {
        $store = $this->storeDao->findById($store);

        if (count($store->getProducts()) > 0) {
            foreach ($store->getProducts() as $item) {
                if ($item->getId() == $product->getId()) {
                    return $item;
                }
            }
        }

        throw new \InvalidArgumentException('There is not stock, search in other store');
    }

    /**
     * @param StoreProduct $storeProduct
     * @param $amount
     * @return int
     */
    public function purchase(StoreProduct $storeProduct, $amount)
    {
        $storeProduct = $this->storeDao->findStoreProductStock($storeProduct);
        if ($storeProduct !== null) {
            if ($storeProduct->getStock() >= $amount) {
                $this->storeDao->popFromStock($storeProduct, $amount);
                return $storeProduct->getStock();
            }
        }
    }
}
