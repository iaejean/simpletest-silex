<?php
declare(strict_types = 1);

namespace Iaejean\Entity;

use Doctrine\ORM\Mapping as ORM;
use Iaejean\Product\Product;
use Iaejean\Store\Store;
use JMS\Serializer\Annotation as Serializer;

/**
 * Class ProductEntity
 * @package Iaejean\Entity
 * @ORM\Table(name="product")
 * @ORM\Entity()
 */
class ProductEntity extends Product
{
    /**
     * @var integer
     * @ORM\Id()
     * @ORM\GeneratedValue(strategy="AUTO")
     * @ORM\Column("id_product", type="integer", length=11, nullable=false)
     */
    protected $id;
    /**
     * @var string
     * @ORM\Column("v_name", type="string", length=45, nullable=false)
     */
    protected $name;
    /**
     * @var string
     * @ORM\Column("v_description", type="string", length=255, nullable=false)
     */
    protected $description;
    /**
     * @var double
     * @ORM\Column("d_price", type="decimal", length=12, nullable=false)
     */
    protected $price;
    /**
     * @var Store[]
     * @ORM\ManyToMany(targetEntity="Iaejean\Entity\StoreEntity", fetch="LAZY")
     * @ORM\JoinTable(
     *     name="store_has_product",
     *     joinColumns={
     *       @ORM\JoinColumn(name="id_product", referencedColumnName="id_product")
     *     },
     *     inverseJoinColumns={
     *       @ORM\JoinColumn(name="id_store", referencedColumnName="id_store")
     *     }
     * )
     * @Serializer\Exclude()
     */
    protected $stores;
}
