<?php

namespace App\Controller;

use App\Entity\Order;
use App\Repository\OrderRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Serializer\SerializerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Validator\Validator\ValidatorInterface;

class OrderController extends AbstractController
{
    /**
     * Route API pour afficher une commande selon son ID
     * 
     * @Route("/api/order/{id}", name="order_get_one", requirements={"id"="\d+"}, methods={"GET"})
     */
    public function getOne($id, OrderRepository $orderRepository)
    {
        $order = $orderRepository->find($id);

        // si 404 
        if ($order === null) {
            // On retourne un message JSON et un statut 404
            return $this->json(['error' => 'Commande non trouvée.'], Response::HTTP_NOT_FOUND);
        }

        return  $this->json(
            $order,
            200,
            [],
            ["groups" => "order_get_one"]
        );
    }

    /**
     * Route API pour afficher toutes les commandes
     * 
     * @Route("/api/orders", name="order_get_all", methods={"GET"})
     */
    public function getAll(OrderRepository $orderRepository)
    {
        $orders = $orderRepository->findAll();

        return  $this->json(
            $orders,
            200,
            [],
            ["groups" => "order_get_all"]
        );
    }

    /**
     * Route API pour afficher toutes les commandes par ordre de date
     * 
     * @Route("/api/ordersByDate", name="order_get_all_by_date", methods={"GET"})
     */
    public function getAllByDate(OrderRepository $orderRepository)
    {
        $orders = $orderRepository->findAllOrdersByDate();

        return  $this->json(
            $orders,
            200,
            [],
            ["groups" => "order_get_all"]
        );
    }

    /**
     * Route API pour afficher toutes les commandes par ordre de prix
     * 
     * @Route("/api/ordersByPrice", name="order_get_all_by_price", methods={"GET"})
     */
    public function getAllByPrice(OrderRepository $orderRepository)
    {
        $orders = $orderRepository->findAllOrdersByPrice();

        return  $this->json(
            $orders,
            200,
            [],
            ["groups" => "order_get_all"]
        );
    }

    /**
     * Route API pour afficher toutes les commandes par ordre de status
     * 
     * @Route("/api/ordersByStatus", name="order_get_all_by_status", methods={"GET"})
     */
    public function getAllByStatus(OrderRepository $orderRepository)
    {
        $orders = $orderRepository->findAllOrdersByStatus();

        return  $this->json(
            $orders,
            200,
            [],
            ["groups" => "order_get_all"]
        );
    }

    /**
     * Route API pour ajouter une commande
     * 
     * @Route("/api/order", name="order_post", methods={"POST"})
     */
    public function addOrder(Request $request, SerializerInterface $serializer, ValidatorInterface $validator, OrderRepository $orderRepository, EntityManagerInterface $entityManager)
    {
        // Le JSON est dans le contenu de la requête
        $content = $request->getContent();

        // Déserialise le JSON en entité Doctrine
        $order = $serializer->deserialize($content, Order::class, 'json');

        //Pour ne pas recréer des produits déjà existants
        $attachOrder = $orderRepository->attachOrder($order);

        // Flusher via le manager
        $entityManager->persist($attachOrder);
        $entityManager->flush();

        // Rediriger vers l'URL de la ressource avec un statut 201
        return $this->redirectToRoute('order_get_one', ['id' => $order->getId()], Response::HTTP_CREATED);
    }
}
