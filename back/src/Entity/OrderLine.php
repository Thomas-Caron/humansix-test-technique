<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;
use App\Repository\OrderLineRepository;
use Symfony\Component\Serializer\Annotation\Groups;

/**
 * @ORM\Entity(repositoryClass=OrderLineRepository::class)
 */
class OrderLine
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     * @Groups({"order_get_one", "order_get_all"})
     */
    private $id;

    /**
     * @ORM\Column(type="integer")
     * @Groups({"order_get_one", "order_get_all"})
     */
    private $quantity;

    /**
     * @ORM\ManyToOne(targetEntity=Product::class, inversedBy="orderLines", cascade="persist")
     * @ORM\JoinColumn(nullable=false)
     * @Groups({"order_get_one", "order_get_all"})
     */
    private $product;

    /**
     * @ORM\ManyToOne(targetEntity=Order::class, inversedBy="orderLines")
     * @ORM\JoinColumn(nullable=false)
     */
    private $order;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getQuantity(): ?int
    {
        return $this->quantity;
    }

    public function setQuantity(int $quantity): self
    {
        $this->quantity = $quantity;

        return $this;
    }

    public function getProduct(): ?Product
    {
        return $this->product;
    }

    public function setProduct(?Product $product): self
    {
        $this->product = $product;

        return $this;
    }

    public function getOrder(): ?Order
    {
        return $this->order;
    }

    public function setOrder(?Order $order): self
    {
        $this->order = $order;

        return $this;
    }
}
