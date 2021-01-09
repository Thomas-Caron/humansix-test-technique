<?php

namespace App\Repository;

use App\Entity\Order;
use App\Entity\Product;
use Doctrine\Persistence\ManagerRegistry;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;

/**
 * @method Order|null find($id, $lockMode = null, $lockVersion = null)
 * @method Order|null findOneBy(array $criteria, array $orderBy = null)
 * @method Order[]    findAll()
 * @method Order[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class OrderRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Order::class);
    }

    /**
     * Return orders by date
     */
    public function findAllOrdersByDate()
    {
        return $this->createQueryBuilder('o')
        ->addSelect('c')
        ->addSelect('ol')
        ->addSelect('p')
        ->join('o.customer', 'c')
        ->join('o.orderLines', 'ol')
        ->join('ol.product', 'p')
        ->orderBy('o.createdAt', 'ASC')
        ->getQuery()
        ->getResult();
    }

    /**
     * Return orders by price
     */
    public function findAllOrdersByPrice()
    {
        return $this->createQueryBuilder('o')
        ->addSelect('c')
        ->addSelect('ol')
        ->addSelect('p')
        ->join('o.customer', 'c')
        ->join('o.orderLines', 'ol')
        ->join('ol.product', 'p')
        ->orderBy('o.price', 'ASC')
        ->getQuery()
        ->getResult();
    }

    /**
     * Return orders by status
     */
    public function findAllOrdersByStatus()
    {
        return $this->createQueryBuilder('o')
        ->addSelect('c')
        ->addSelect('ol')
        ->addSelect('p')
        ->join('o.customer', 'c')
        ->join('o.orderLines', 'ol')
        ->join('ol.product', 'p')
        ->orderBy('o.status', 'ASC')
        ->getQuery()
        ->getResult();
    }

    public function attachOrder(Order $order)
    {
        $productRepository = $this->getEntityManager()->getRepository(Product::class);
        
        // Récupération de la liste des produits qu'il faut rattaccher à l'entity manager
        $products = $order->getProducts();
        $attachedProducts = $productRepository->attachProducts($products);
        $order->reloadProducts($attachedProducts);

        return $order;
    }

    // /**
    //  * @return Order[] Returns an array of Order objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('o')
            ->andWhere('o.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('o.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?Order
    {
        return $this->createQueryBuilder('o')
            ->andWhere('o.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
