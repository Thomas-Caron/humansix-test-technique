<?php

namespace App\Entity;

use Exception;
use App\Entity\OrderLine;
use Doctrine\ORM\Mapping as ORM;
use Doctrine\Common\Collections\Collection;
use Doctrine\Common\Collections\ArrayCollection;
use Symfony\Component\Serializer\Annotation\Groups;

/**
 * @ORM\Entity(repositoryClass=OrderRepository::class)
 * @ORM\Table(name="`order`")
 */
class Order
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     * @Groups({"order_get_one", "order_get_all"})
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=100)
     * @Groups({"order_get_one", "order_get_all"})
     */
    private $status;

    /**
     * @ORM\Column(type="decimal")
     * @Groups({"order_get_one", "order_get_all"})
     */
    private $price;

    /**
     * @ORM\Column(type="datetime")
     * @Groups({"order_get_one", "order_get_all"})
     */
    private $createdAt;

    /**
     * @ORM\OneToMany(targetEntity=OrderLine::class, mappedBy="order", orphanRemoval=true, cascade="persist")
     * @Groups({"order_get_one", "order_get_all"})
     */
    private $orderLines;

    /**
     * @ORM\ManyToOne(targetEntity=Customer::class, inversedBy="orders", cascade="persist")
     * @ORM\JoinColumn(nullable=false)
     * @Groups({"order_get_one", "order_get_all"})
     */
    private $customer;

    public function __construct()
    {
        $this->createdAt = new \DateTime();
        $this->orderLines = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getStatus(): ?string
    {
        return $this->status;
    }

    public function setStatus(string $status): self
    {
        $this->status = $status;

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

    public function getCreatedAt(): ?\DateTimeInterface
    {
        return $this->createdAt;
    }

    public function setCreatedAt(\DateTimeInterface $createdAt): self
    {
        $this->createdAt = $createdAt;

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
            $orderLine->setOrder($this);
        }

        return $this;
    }

    public function removeOrderLine(OrderLine $orderLine): self
    {
        if ($this->orderLines->removeElement($orderLine)) {
            // set the owning side to null (unless already changed)
            if ($orderLine->getOrder() === $this) {
                $orderLine->setOrder(null);
            }
        }

        return $this;
    }

    /**
    * @return Collection|OrderLine[]
    */
    public function getProducts(): Collection
    {
        $lines = $this->getOrderLines();
        $products = new ArrayCollection();
        foreach($lines as $line) {
            $products[] = $line->getProduct();
        }
        return $products;
    }

    public function reloadProducts(Collection $products)
    {
        foreach($products as $product) {
            $this->reloadOrderLineProduct($product);
        }
    }

    public function reloadOrderLineProduct(Product $product)
    {
        // Pour chaque ligne de commande
        foreach($this->getOrderLines() as $line) {
            $lineProduct = $line->getProduct();
            // Si l'id du produit associé à la ligne de commande est égal au produit, alors on peut réaffecter le produit
            if($lineProduct->getId() === $product->getId()) {
                $line->setProduct($product);
                return $this;
            }
        }
        // throw new Exception('In ' . Order::class . ' instance ('.$this->getId().') : there is no ' . OrderLine::class . ' with a product_id = "' . $product->getId() .'"');
    }

    public function getCustomer(): ?Customer
    {
        return $this->customer;
    }

    public function setCustomer(?Customer $customer): self
    {
        $this->customer = $customer;

        return $this;
    }
}
