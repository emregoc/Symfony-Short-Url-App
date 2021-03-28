<?php

namespace App\Controller\Oylesine;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class OylesineController extends AbstractController
{
    #[Route('/oylesine/oylesine', name: 'oylesine_oylesine')]
    public function index(): Response
    {
        return $this->render('oylesine/oylesine/index.html.twig', [
            'controller_name' => 'OylesineController',
        ]);
    }
}
