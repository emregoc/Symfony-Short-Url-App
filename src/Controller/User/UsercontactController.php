<?php

namespace App\Controller\User;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class UsercontactController extends AbstractController
{
    #[Route('/user/usercontact', name: 'user_usercontact')]
    public function index(): Response
    {
        return $this->render('user/usercontact/index.html.twig', [
            'controller_name' => 'usercontactController',
        ]);
    }
}
