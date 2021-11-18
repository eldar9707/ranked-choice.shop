<?php

namespace App\Controller;

use App\Entity\Product;
use Exception;
use RuntimeException;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class DefaultController extends AbstractController
{
    /**
     * @Route("/", name="homepage")
     */
    public function index(): Response
    {
        $products = $this->getDoctrine()->getManager()->getRepository(Product::class)->findAll();
        dd($products);
        return $this->render('main/default/index.html.twig');
    }

    /**
     * @Route("/insetr_product", name="product_insert")
     * @throws Exception
     */
    public function insertProduct(): Response
    {
        $product = new Product();
        $product->setTitle('Product-'.random_int(1, 100));
        $product->setDescription('Description '.$product->getTitle());
        $product->setPrice(10);
        $product->setUuid(uniqid('', true));
        $product->setQuantity(1);

        $entityManager = $this->getDoctrine()->getManager();
        $entityManager->persist($product);
        $entityManager->flush();

        return $this->redirectToRoute('homepage');
    }

    /**
     * @Route("/edit_product/{id}", methods="GET|POST", name="product_edit", requirements={"id"="\d+"})
     * @param  Request  $request
     * @param  int|null  $id
     * @return Response
     */
    public function editProduct(Request $request, int $id = null): Response
    {
        $product = $this
            ->getDoctrine()
            ->getManager()
            ->getRepository(Product::class)
            ->find($id);

        if ($product === null) {
            throw new RuntimeException('Not Product');
        }
        $form = $this
            ->createFormBuilder($product)
            ->add('title', TextType::class)
            ->getForm();

        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            $form->getData();
            $this
                ->getDoctrine()
                ->getManager()
                ->persist($product);
            $this
                ->getDoctrine()
                ->getManager()
                ->flush();

            return $this->redirectToRoute('product_edit',['id' => $product->getId()]);
        }

        return $this->render('main/default/edit_product.html.twig', [
            'form' => $form->createView()
        ]);
    }

    /**
     * @Route("/add_product",methods="POST", name="product_add")
     * @param  Request  $request
     * @return Response
     */
    public function addProduct(Request $request): Response
    {
        $form = $this->createFormBuilder();


        return $this->render('main/default/edit_product.html.twig');
    }


}
