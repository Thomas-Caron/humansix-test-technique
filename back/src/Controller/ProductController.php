<?php

namespace App\Controller;

use App\Entity\Product;
use App\Repository\ProductRepository;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class ProductController extends AbstractController
{
    /**
     * Route API pour afficher un produit selon sa référence
     * 
     * @Route("/api/product/{sku}", name="product_get_one", methods={"GET"})
     * 
     * @todo Faire le "requirement" pour le sku
     */
    public function getOne(Product $product = null)
    {
        // si 404 
        if ($product === null) {
            // On retourne un message JSON + un statut 404
            return $this->json(['error' => 'Produit non trouvé.'], Response::HTTP_NOT_FOUND);
        }

        return  $this->json(
            $product,
            200,
            [],
            ["groups" => "product_get_one"]
        );
    }

    /**
     * Route API pour afficher tout les produits
     * 
     * @Route("/api/products", name="product_get_all", methods={"GET"})
     */
    public function getAll(ProductRepository $productRepository)
    {
        $products = $productRepository->findAll();

        return  $this->json(
            $products,
            200,
            [],
            ["groups" => "product_get_all"]
        );
    }
}
