<?php

namespace App\Controller;

use App\Entity\Product;
use DateTimeImmutable;
use Exception;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class DefaultController extends AbstractController
{
    /**
     * @Route("/", name="homepage")
     */
    public function index(): Response
    {
       $products =  $this->getDoctrine()->getManager()->getRepository(Product::class)->findAll();
        dd($products);
        return $this->render('main/default/index.html.twig');
    }

    /**
     * @Route("/product_add", name="product_add")
     * @throws Exception
     */
    public function addProduct(): Response
    {
        $product = new Product();
        $product->setTitle('Product-'. random_int(1, 100));
        $product->setDescription('Description ' . $product->getTitle());
        $product->setPrice(10);
        $product->setQuantity(1);

        $entityManager = $this->getDoctrine()->getManager();
        $entityManager->persist($product);
        $entityManager->flush();

        return $this->redirectToRoute('homepage');
    }

}
