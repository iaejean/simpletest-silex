<?php
declare (strict_types = 1);

namespace Iaejean\Entity;

use Doctrine\ORM\Mapping as ORM;
use Iaejean\Product\Product;
use Iaejean\Store\Store;
use JMS\Serializer\Annotation as Serializer;

/**
 * Class StoreEntity
 * @package Iaejean\Entity
 * @ORM\Table(name="store")
 * @ORM\Entity()
 */
class StoreEntity extends Store
{
    /**
     * @var integer
     * @ORM\Id()
     * @ORM\GeneratedValue(strategy="AUTO")
     * @ORM\Column("id_store", type="integer", length=11, nullable=false)
     */
    protected $id;
    /**
     * @var string
     * @ORM\Column("v_name", type="string", length=45, nullable=false)
     */
    protected $name;
    /**
     * @var string
     * @ORM\Column("v_address", type="string", length=45, nullable=false)
     */
    protected $address;
    /**
     * @var Product[]
     * @ORM\ManyToMany(targetEntity="Iaejean\Entity\ProductEntity", fetch="LAZY")
     * @ORM\JoinTable(
     *     name="store_has_product",
     *     joinColumns={
     *       @ORM\JoinColumn(name="id_store", referencedColumnName="id_store")
     *     },
     *     inverseJoinColumns={
     *       @ORM\JoinColumn(name="id_product", referencedColumnName="id_product")
     *     }
     * )
     * @Serializer\Exclude()
     */
    protected $products;
}
