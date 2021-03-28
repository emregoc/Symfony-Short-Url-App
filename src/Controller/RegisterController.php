<?php

namespace App\Controller;

use App\Entity\User;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;
use Symfony\Component\Security\Http\Authentication\AuthenticationUtils;

class RegisterController extends AbstractController
{
    #[Route('/register', name: 'register')]
    public function index(Request $request, UserPasswordEncoderInterface $encoder): Response
    {
        $username = $request-> request -> get('email');// formdaki inputun name ismi bu şekilde veriyi alcaz
        $password = $request-> request -> get('password');
        $user = new User();

        $encoded = $encoder->encodePassword($user, $password);

        $user->setEmail($username)
            ->setPassword($encoded)
            ->setRoles(['ROLE_USER'])
            ->setIsActive(true);

        $em = $this->getDoctrine()->getManager();

        $em->persist($user);
        $em->flush();
        return $this->redirectToRoute('home'); // user kayıtı yapıldıktan sonra anasayfaya yönlendirdik
       // return new Response('User created !');

    }

    #[Route('/userupdate', name: 'updatepage')]
    public function userupdate(Request $request) // post ettiğimiz verileri böyle yakalıyoruz
    {
       $usersession = $this->getUser(); // giriş yapan kullanıcının bilgilerini aldık

       $user = $this->getDoctrine()
            ->getRepository(User::class)
            ->find($usersession->getid()); // User entitiy'si içindeki id yi değişkene attık

        if($request->isMethod('POST')){
            $user->setEmail($request->request->get('email')); # email -> profile/index.html.twig deki input adı
             
            
            $this->getDoctrine()->getManager()->flush();
            return $this->redirectToRoute('/profile');
        }
        return $this->render('profile/index.html.twig',[
            'user' => $user
        ]);
    }

}
