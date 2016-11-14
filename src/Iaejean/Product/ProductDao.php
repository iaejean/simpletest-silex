<?php
declare(strict_types = 1);

namespace Iaejean\Product;

use Ding\Logger\ILoggerAware;
use Doctrine\ORM\EntityManager;
use Iaejean\Base\TraitLoggerAware;

/**
 * Class ProductDao
 * @package Iaejean\Product
 * @Component(name=product_dao);
 * @Singleton
 */
class ProductDao implements ILoggerAware
{
    /**
     * @var EntityManager
     * @Value(value=${entity_manager})
     */
    private $entityManager;
    use TraitLoggerAware;

    /**
     * @return array
     */
    public function findAll(): array
    {
        $repository = $this->entityManager->getRepository('Iaejean\Entity\ProductEntity');
        return $repository->findAll();
    }

    /**
     * @param Product $product
     * @return Product
     */
    public function findById(Product $product): Product
    {
        $repository = $this->entityManager->getRepository('Iaejean\Entity\ProductEntity');
        return $repository->findOneBy([
            'id' => $product->getId()
        ]);
    }
}
