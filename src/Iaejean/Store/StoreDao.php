<?php
declare(strict_types = 1);

namespace Iaejean\Store;

use Ding\Logger\ILoggerAware;
use Doctrine\ORM\EntityManager;
use Iaejean\Base\TraitLoggerAware;
use Iaejean\Entity\StoreProdcutEntity;

/**
 * Class StoreDao
 * @package Iaejean\Store
 * @Component(name=store_dao)
 * @Singleton
 */
class StoreDao implements ILoggerAware
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
        $repository = $this->entityManager->getRepository('Iaejean\Entity\StoreEntity');
        return  $repository->findAll();
    }

    /**
     * @param Store $store
     * @return Store
     */
    public function findById(Store $store): Store
    {
        $repository = $this->entityManager->getRepository('Iaejean\Entity\StoreEntity');
        return  $repository->findOneBy([
            'id' => $store->getId()
        ]);
    }

    /**
     * @param StoreProduct $storeProduct
     * @return StoreProduct
     */
    public function findStoreProductStock(StoreProduct $storeProduct): StoreProduct
    {
        $repository = $this->entityManager->getRepository('Iaejean\Entity\StoreProductEntity');
        return $repository->findOneBy([
            'idStore'=> $storeProduct->getIdStore(),
            'idProduct' => $storeProduct->getIdProduct()
        ]);
    }

    /**
     * @param StoreProduct $storeProduct
     * @param $amount
     * @return bool
     */
    public function popFromStock(StoreProduct $storeProduct, $amount): bool
    {
        $entity = $this->findStoreProductStock($storeProduct);
        $entity->setStock($entity->getStock() - $amount);
        $this->entityManager->persist($entity);
        $this->entityManager->flush();
        return true;
    }
}
