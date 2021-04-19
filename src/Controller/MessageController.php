<?php

namespace App\Controller;

use App\Entity\Message;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class MessageController extends AbstractController
{
    #[Route('/addmessage', name: 'message')] // mesajı veri tabanına kaydediyoruz
    public function index(Request $request): Response
    {

        $name = $request->request->get('name'); // formdaki inputların adı
        $surname = $request->request->get('surname');
        $email = $request->request->get('email');
        $message = $request->request->get('message');

        $getMessage = new Message();

        $getMessage->setName($name)
                   ->setSurname($surname)
                   ->setEmail($email)
                   ->setMessage($message)
                   ->setOkundu('Okunmadı')
                   ->setCevaplandi('Cevaplanmadı');
        
        $em = $this->getDoctrine()->getManager();
        $em->persist($getMessage);
        $em->flush();

        return $this->redirectToRoute('home');
    }
}
