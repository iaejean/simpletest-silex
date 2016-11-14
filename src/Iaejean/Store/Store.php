<?php
declare(strict_types = 1);

namespace Iaejean\Store;

use Iaejean\Product\Product;
use JMS\Serializer\Annotation as Serializer;

/**
 * Class Store
 * @package Iaejean\Store
 */
class Store
{
    /**
     * @var integer
     * @Serializer\Type("integer")
     */
    protected $id;
    /**
     * @var string
     * @Serializer\Type("string")
     */
    protected $name;
    /**
     * @var string
     * @Serializer\Type("string")
     */
    protected $address;
    /**
     * @var Product[]
     * @Serializer\Type("array<Iaejean\Product\Product>")
     * @Serializer\Exclude()
     */
    protected $products;

    /**
     * @return string
     */
    public function getAddress()
    {
        return $this->address;
    }

    /**
     * @param string $address
     * @return Store
     */
    public function setAddress($address)
    {
        $this->address = $address;
        return $this;
    }

    /**
     * @return int
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @param int $id
     * @return Store
     */
    public function setId($id)
    {
        $this->id = $id;
        return $this;
    }

    /**
     * @return string
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * @param string $name
     * @return Store
     */
    public function setName($name)
    {
        $this->name = $name;
        return $this;
    }

    /**
     * @return Product[]
     */
    public function getProducts()
    {
        return $this->products;
    }

    /**
     * @param Product[] $products
     * @return Store
     */
    public function setProducts($products)
    {
        $this->products = $products;
        return $this;
    }
}
