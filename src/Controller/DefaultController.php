<?php

// src/Controller/DefaultController.php
// ...

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class DefaultController extends Controller
{
    /**
     * @Route("/admin")
     */
    public function admin()
    {
        //return new Response('<html><body>Admin page!</body></html>');
        return $this->render('admin.html.twig');
    }

    /**
     * @Route("/")
     */
    public function index()
    {
        $em = $this->getDoctrine()->getManager();
        $users = $em->getRepository('App:User')->findAll();
        //return $this->json($users);
        //return new Response('<html><body>Index page!</body></html>');

        return $this->render('index.html.twig', array('users' => $users));
    }
}