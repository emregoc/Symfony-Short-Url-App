<?php

namespace App\Controller\User;

use App\Entity\Url;
use App\Entity\User;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class UserController extends AbstractController
{
    #[Route('/admin/myurl', name: 'naber')]
    public function index(): Response
    {
        $userId=$this->getUser()->getId();
        $em=$this->getDoctrine()->getManager();
        $urlme=$em->getRepository(Url::class)->findBy(['user_id'=>$userId],['click_count'=>'DESC']);
        return $this->render('admin/admin/deneme/index.html.twig', [
            'url'=>$urlme
        ]);
    }
}
