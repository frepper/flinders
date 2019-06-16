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
 * @ORM\Entity()
 * @ORM\Table()
 *
 * @ApiResource(
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
     * @Groups({"product:output"})
     *
     * @ApiProperty(identifier=true)
     *
     * @var int
     */
    private $id;

    /**
     * @ORM\Column(type="float")
     *
     * @Groups({"product:output"})
     *
     * @var float
     */
    private $price;

    /**
     * @ORM\Column(type="integer")
     *
     * @Groups({"product:output"})
     *
     * @var integer
     */
    private $quantity;

    /**
     * @ORM\Column(type="date")
     *
     * @Groups({"product:output"})
     *
     * @var \DateTime
     */
    private $date;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Product", inversedBy="sales")
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