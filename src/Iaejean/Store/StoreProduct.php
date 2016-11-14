<?php
declare(strict_types = 1);

namespace Iaejean\Store;

use JMS\Serializer\Annotation as Serializer;

/**
 * Class StoreProduct
 * @package Iaejean\Store
 */
class StoreProduct
{
    /**
     * @var integer
     * @Serializer\Type("integer")
     */
    protected $idProduct;
    /**
     * @var integer
     * @Serializer\Type("integer")
     */
    protected $idStore;
    /**
     * @var integer
     * @Serializer\Type("integer")
     */
    protected $stock;

    /**
     * @return int
     */
    public function getIdProduct()
    {
        return $this->idProduct;
    }

    /**
     * @param int $idProduct
     * @return StoreProduct
     */
    public function setIdProduct($idProduct)
    {
        $this->idProduct = $idProduct;
        return $this;
    }

    /**
     * @return int
     */
    public function getIdStore()
    {
        return $this->idStore;
    }

    /**
     * @param int $idStore
     * @return StoreProduct
     */
    public function setIdStore($idStore)
    {
        $this->idStore = $idStore;
        return $this;
    }

    /**
     * @return int
     */
    public function getStock()
    {
        return $this->stock;
    }

    /**
     * @param int $stock
     * @return StoreProduct
     */
    public function setStock($stock)
    {
        $this->stock = $stock;
        return $this;
    }
}
