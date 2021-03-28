<?php

namespace App\Controller\Admin;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class UrlController extends AbstractController
{
    #[Route('/admin/url', name: 'admin_url')] // Urlleri listeliyeceğimiz controller
    public function index(): Response
    {
        return $this->render('admin/url/index.html.twig', [
            'controller_name' => 'UrlController',
        ]);
    }
}
