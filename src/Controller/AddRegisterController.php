<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class AddRegisterController extends AbstractController
{
    #[Route('/addregister', name: 'add_register')]
    public function index(): Response
    {
        return $this->render('add_register/index.html.twig', [
            'controller_name' => 'AddRegisterController',
        ]);
    }
}
