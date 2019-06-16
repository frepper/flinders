<?php
/**
 * Created by PhpStorm.
 * User: alfon
 * Date: 6/16/2019
 * Time: 11:17
 */

namespace App\Entity;

use ApiPlatform\Core\Annotation\ApiResource;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Serializer\Annotation\Groups;

/**
 * Class Sales
 * @package App\Entity
 *
 * @ORM\Entity()
 * @ORM\Table()
 *
 * @ApiResource(
 *     normalizationContext={"groups"={"product:output"}},
 *     collectionOperations={"get"},
 *     itemOperations={"get"}
 * )
 */
class Product
{
    /**
     * @ORM\Id
     * @ORM\Column(type="integer")
     * @ORM\GeneratedValue(strategy="IDENTITY")
     *
     * @Groups({"product:output"})
     *
     * @var int
     */
    private $id;

    /**
     * @ORM\Column(type="string")
     *
     * @Groups({"product:output"})
     *
     * @var string
     */
    private $name;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\Sales", mappedBy="product", cascade={"persist"}, orphanRemoval=true)
     *
     * @Groups({"product:output"})
     *
     * @var ArrayCollection
     */
    private $sales;

    /**
     * Product constructor.
     */
    public function __construct()
    {
        $this->sales = new ArrayCollection();
    }


    /**
     * @return int
     */
    public function getId(): ?int
    {
        return $this->id;
    }

    /**
     * @return string|null
     */
    public function getName(): ?string
    {
        return $this->name;
    }

    /**
     * @param string|null $name
     * @return Product
     */
    public function setName(?string $name): Product
    {
        $this->name = $name;
        return $this;
    }

    /**
     * @return ArrayCollection
     */
    public function getSales()
    {
        return $this->sales;
    }

    /**
     * @param Sales $sales
     * @return $this
     */
    public function addSales(Sales $sales)
    {
        if (!$this->sales->contains($sales)) {
            $this->sales->add($sales);
        }
        return $this;
    }

    /**
     * @param Sales $sales
     * @return $this
     */
    public function removeSales(Sales $sales)
    {
        if ($this->sales->contains($sales)) {
            $this->sales->removeElement($sales);
            $sales->setProduct(null);
        }
        return $this;
    }

}