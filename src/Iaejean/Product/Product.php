<?php
declare(strict_types = 1);

namespace Iaejean\Product;

use Iaejean\Store\Store;
use JMS\Serializer\Annotation as Serializer;

/**
 * Class Product
 * @package Iaejean\Product
 */
class Product
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
    protected $description;
    /**
     * @var double
     * @Serializer\Type("float")
     */
    protected $price;
    /**
     * @var Store[]
     * @Serializer\Type("array<Iaejean\Store\Store>")
     * @Serializer\Exclude()
     */
    protected $stores;

    /**
     * @return string
     */
    public function getDescription()
    {
        return $this->description;
    }

    /**
     * @param string $description
     * @return Product
     */
    public function setDescription($description)
    {
        $this->description = $description;
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
     * @return Product
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
     * @return Product
     */
    public function setName($name)
    {
        $this->name = $name;
        return $this;
    }

    /**
     * @return float
     */
    public function getPrice()
    {
        return $this->price;
    }

    /**
     * @param float $price
     * @return Product
     */
    public function setPrice($price)
    {
        $this->price = $price;
        return $this;
    }

    /**
     * @return \Iaejean\Store\Store[]
     */
    public function getStores()
    {
        return $this->stores;
    }

    /**
     * @param \Iaejean\Store\Store[] $stores
     * @return Product
     */
    public function setStores($stores)
    {
        $this->stores = $stores;
        return $this;
    }
}
