<?php
declare(strict_types = 1);

namespace Iaejean\Product;

use Ding\Logger\ILoggerAware;
use Iaejean\Base\TraitLoggerAware;

/**
 * Class ProductService
 * @package Iaejean\Product
 * @Component(name=product_service)
 * @Singleton
 */
class ProductService implements ILoggerAware
{
    use TraitLoggerAware;

    /**
     * @var ProductDao
     * @Resource(name=product_dao)
     */
    private $productDao;

    /**
     * @return array
     */
    public function findAll(): array
    {
        return $this->productDao->findAll();
    }

    /**
     * @param Product $product
     * @return mixed
     */
    public function getStores(Product $product)
    {
        $product = $this->productDao->findById($product);
        return $product->getStores();
    }
}
