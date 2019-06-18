<?php
/**
 * Created by PhpStorm.
 * User: alfon
 * Date: 6/16/2019
 * Time: 11:08
 */

namespace App\Entity;

use ApiPlatform\Core\Annotation\ApiProperty;
use ApiPlatform\Core\Annotation\ApiResource;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Serializer\Annotation\Groups;

/**
 * Class Sales
 * @package App\Entity
 *
 * @ORM\Entity(repositoryClass="App\Entity\Repository\SalesRepository")
 * @ORM\Table()
 *
 * @ApiResource(
 *     normalizationContext={"groups"={"sales:output"}, "datetime_format"="Y-m-d"},
 *     collectionOperations={"get"},
 *     itemOperations={"get"}
 * )
 */
class Sales
{

    /**
     * @ORM\Id
     * @ORM\Column(type="integer")
     * @ORM\GeneratedValue(strategy="IDENTITY")
     *
     * @Groups({"sales:output", "product:output"})
     *
     * @ApiProperty(identifier=true)
     *
     * @var int
     */
    private $id;

    /**
     * @ORM\Column(type="float")
     *
     * @Groups({"sales:output", "product:output"})
     *
     * @var float
     */
    private $price;

    /**
     * @ORM\Column(type="integer")
     *
     * @Groups({"sales:output", "product:output"})
     *
     * @var integer
     */
    private $quantity;

    /**
     * @ORM\Column(type="date")
     *
     * @Groups({"sales:output", "product:output"})
     *
     * @var \DateTime
     */
    private $date;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Product", inversedBy="sales")
     *
     * @Groups({"sales:output"})
     *
     * @var Product
     */
    private $product;

    /**
     * @return int|null
     */
    public function getId(): ?int
    {
        return $this->id;
    }

    /**
     * @return float|null
     */
    public function getPrice(): ?float
    {
        return $this->price;
    }

    /**
     * @param float|null $price
     * @return Sales
     */
    public function setPrice(?float $price): Sales
    {
        $this->price = $price;
        return $this;
    }

    /**
     * @return int|null
     */
    public function getQuantity(): ?int
    {
        return $this->quantity;
    }

    /**
     * @param int|null $quantity
     * @return Sales
     */
    public function setQuantity(?int $quantity): Sales
    {
        $this->quantity = $quantity;
        return $this;
    }

    /**
     * @return \DateTime|null
     */
    public function getDate(): ?\DateTime
    {
        return $this->date;
    }

    /**
     * @param \DateTime|null $date
     * @return Sales
     */
    public function setDate(?\DateTime $date): Sales
    {
        $this->date = $date;
        return $this;
    }

    /**
     * @return Product|null
     */
    public function getProduct(): ?Product
    {
        return $this->product;
    }

    /**
     * @param Product|null $product
     * @return Sales
     */
    public function setProduct(?Product $product): Sales
    {
        $this->product = $product;
        return $this;
    }


}