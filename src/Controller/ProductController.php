<?php

namespace App\Controller;

use DateTime;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Doctrine\Persistence\ManagerRegistry;
use App\Entity\Product;

class ProductController extends AbstractController {

    #[Route('/product', name: 'app_product')]
    public function index(): Response {
        return $this->render('product/index.html.twig', [
            'controller_name' => 'ProductController',
        ]);
    }

    #[Route("/product/create", name: "app_product_create")]
    public function createProduct(ManagerRegistry $doctrine): Response {
        $entityManager = $doctrine->getManager();
        $product = new Product();
        $product->setName("Keyboard");
        $product->SetPrice(1999);
        $entityManager->persist($product);
        $entityManager->flush();
        return $this->render('product/index.html.twig', [
            'controller_name' => $product->getId(),
        ]);
    }

    #[Route("/product/{id}", name: "app_product_detail")]
    public function detailProduct(ManagerRegistry $doctrine, int $id): Response {
        $manager = $doctrine->getManager();
        $repository = $doctrine->getRepository(Product::class);
        $product = $repository->find($id);
        if (!$product) {
            throw $this->createNotFoundException("No product");
        }
        $now = new DateTime();
        $product->setName("Test ".$now->getTimestamp());
        $manager->flush();
        return $this->render('product/index.html.twig', [
            'controller_name' => $product->getName(),
        ]);
    }

}
