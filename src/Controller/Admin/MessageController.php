<?php

namespace App\Controller\Admin;

use App\Entity\Message;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class MessageController extends AbstractController
{
    #[Route('/admin/message', name: 'admin_message')]
    public function index(): Response
    {
        $em = $this->getDoctrine()->getManager();
        $messageRepository = $em->getRepository(Message::class);
        $message_items = $messageRepository->findAll();

        return $this->render('admin/admin/adminmessage.html.twig', [
            'controller_name' => 'MessageController',
            'message_items' => $message_items
        ]);
    }
}
