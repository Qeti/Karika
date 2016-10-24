<?php

namespace AppBundle\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class IndexController extends Controller
{

    /**
     * @Route("/login")
     */
    public function loginAction()
    {
        return $this->render('AppBundle:Index:index.html.twig', [
            'text' => 'Login page'
        ]);
    }

    /**
     * @Route("/signup")
     */
    public function signupAction()
    {
        return $this->render('AppBundle:Index:index.html.twig', [
            'text' => 'Signup page'
        ]);
    }

    /**
     * @Route("/password/forgot")
     */
    public function forgotPasswordAction()
    {
        return $this->render('AppBundle:Index:index.html.twig', [
            'text' => 'Oh, I forget my password! I can input my email here to receive url with token for reset my password.'
        ]);
    }

    /**
     * @Route("/password/reset")
     */
    public function resetPasswordAction()
    {
        return $this->render('AppBundle:Index:index.html.twig', [
            'text' => 'Here I can reset my password with token from email'
        ]);
    }

    /**
     * Action for All routes besides described above and in routes.yml
     *
     * Order of actions is important. This action must be last.
     *
     * @Route("/{slug}")
     */
    public function indexAction()
    {
        return $this->render('AppBundle:Index:index.html.twig', [
            'text' => 'indexAction'
        ]);
    }

}
