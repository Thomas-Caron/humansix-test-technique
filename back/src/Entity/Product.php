<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;
use App\Repository\ProductRepository;
use Doctrine\Common\Collections\Collection;
use Doctrine\Common\Collections\ArrayCollection;
use Symfony\Component\Serializer\Annotation\Groups;

/**
 * @ORM\Entity(repositoryClass=ProductRepository::class)
 */
class Product
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     * @Groups({"order_get_one", "order_get_all"})
     * @Groups({"product_get_one", "product_get_all"})
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=100)
     * @Groups({"order_get_one", "order_get_all"})
     * @Groups({"product_get_one", "product_get_all"})
     */
    private $sku;

    /**
     * @ORM\Column(type="string", length=100)
     * @Groups({"order_get_one", "order_get_all"})
     * @Groups({"product_get_one", "product_get_all"})
     */
    private $name;

    /**
     * @ORM\Column(type="decimal")
     * @Groups({"order_get_one", "order_get_all"})
     * @Groups({"product_get_one", "product_get_all"})
     */
    private $price;

    /**
     * @ORM\OneToMany(targetEntity=OrderLine::class, mappedBy="product", orphanRemoval=true)
     */
    private $orderLines;

    public function __construct()
    {
        $this->orderLines = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getSku(): ?string
    {
        return $this->sku;
    }

    public function setSku(string $sku): self
    {
        $this->sku = $sku;

        return $this;
    }

    public function getName(): ?string
    {
        return $this->name;
    }

    public function setName(string $name): self
    {
        $this->name = $name;

        return $this;
    }

    public function getPrice(): ?int
    {
        return $this->price;
    }

    public function setPrice(int $price): self
    {
        $this->price = $price;

        return $this;
    }

    /**
     * @return Collection|OrderLine[]
     */
    public function getOrderLines(): Collection
    {
        return $this->orderLines;
    }

    public function addOrderLine(OrderLine $orderLine): self
    {
        if (!$this->orderLines->contains($orderLine)) {
            $this->orderLines[] = $orderLine;
            $orderLine->setProduct($this);
        }

        return $this;
    }

    public function removeOrderLine(OrderLine $orderLine): self
    {
        if ($this->orderLines->removeElement($orderLine)) {
            // set the owning side to null (unless already changed)
            if ($orderLine->getProduct() === $this) {
                $orderLine->setProduct(null);
            }
        }

        return $this;
    }
}
