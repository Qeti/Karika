<?php

namespace AppBundle\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class IndexController extends Controller
{

    /**
     * @Route("/")
     */
    public function indexAction()
    {
        return $this->render('AppBundle:Index:index.html.twig', [
                // ...
        ]);
    }

}
