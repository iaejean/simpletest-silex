<?php
declare(strict_types = 1);

namespace Iaejean\Entity;

use Doctrine\ORM\Mapping as ORM;
use Iaejean\Store\StoreProduct;

/**
 * Class StoreProductEntity
 * @package Iaejean\Entity
 * @ORM\Table(name="store_has_product")
 * @ORM\Entity()
 */
class StoreProductEntity extends StoreProduct
{
    /**
     * @var integer
     * @ORM\Column("id_store", type="integer", length=10, nullable=false)
     * @ORM\Id()
     */
    protected $idStore;
    /**
     * @var integer
     * @ORM\Column("id_product", type="integer", length=10, nullable=false)
     * @ORM\Id()
     */
    protected $idProduct;
    /**
     * @var integer
     * @ORM\Column("i_stock", type="integer", length=10, nullable=false)
     */
    protected $stock;
}
