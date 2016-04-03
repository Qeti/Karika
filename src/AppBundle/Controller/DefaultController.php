<?php

namespace AppBundle\Controller;

use AppBundle\Entity\Product;
use AppBundle\Entity\Category;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

class DefaultController extends Controller
{
    /**
     * @Route("/", name="homepage")
     */
    public function indexAction(Request $request)
    {
        // replace this example code with whatever you need
        return $this->render('default/index.html.twig', [
            'base_dir' => realpath($this->getParameter('kernel.root_dir').'/..'),
        ]);
    }

    /**
     * @Route("/info/{slug}", name="info")
     */
    public function infoAction(Request $request, $slug = null)
    {
        $ok = $this->container->get('ok');
        return $this->render('default/info.html.twig', [
            'base_dir' => realpath($this->getParameter('kernel.root_dir').'/..'),
            'slug' => $slug . ' ' . $ok->getMessage(),
        ]);
    }

    /**
     * @Route("/show/{productId}", name="show")
     */
    public function showAction($productId)
    {
        $product = $this->getDoctrine()
            ->getRepository('AppBundle:Product')
            ->findOneByIdJoinedToCategory($productId);

        if (!$product) {
            throw $this->createNotFoundException(
                'No product found for id '.$productId
            );
        }
        $categoryName = $product->getCategory() ? $product->getCategory()->getName() : 'No category';

        return $this->render('default/info.html.twig', [
            'slug' => $product->getName() . '/' . $categoryName,
        ]);
    }

    /**
     * @Route("/create")
     */
    public function createAction()
    {
        $category = new Category();
        $category->setName('Computer Peripherals');
        
        $product = new Product();
        $product->setName('Keyboard');
        $product->setPrice(19.99);
        $product->setDescription('Ergonomic and stylish!');

        // relate this product to the category
        $product->setCategory($category);
        
        $em = $this->getDoctrine()->getManager();

        $em->persist($category);

        // tells Doctrine you want to (eventually) save the Product (no queries yet)
        $em->persist($product);

        // actually executes the queries (i.e. the INSERT query)
        $em->flush();

        return new Response(
            'Saved new product with id '.$product->getId()
            .' and new category with id: '.$category->getId()
        );
    }

    
    /**
     * @Route("/update/{productId}")
     */
    public function updateAction($productId)
    {
        $em = $this->getDoctrine()->getManager();
        $product = $em->getRepository('AppBundle:Product')->find($productId);

        if (!$product) {
            throw $this->createNotFoundException(
                'No product found for id '.$productId
            );
        }

        $product->setName('New product name!');
        $em->flush();

        return $this->redirectToRoute('homepage');
    }
    
}
