<?php

namespace App\Controller;

use App\Entity\User;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;
use Symfony\Component\Security\Http\Authentication\AuthenticationUtils;

class SecurityController extends AbstractController
{
    /**
     * @Route("/login", name="app_login")
     */
    public function login(AuthenticationUtils $authenticationUtils): Response
    {
        // if ($this->getUser()) {
          //  return $this->redirectToRoute('/');
       //  }

        // get the login error if there is one
        $error = $authenticationUtils->getLastAuthenticationError(); // hatalı giriş yapılırsa gösterilcek mesaj
        // last username entered by the user
        $lastUsername = $authenticationUtils->getLastUsername(); //en son kim giriş yaparsa username'i

        return $this->render('security/login.html.twig', ['last_username' => $lastUsername, 'error' => $error]);
        // bir üst satırdaki return sanırım kullanıcı giriş yapmadan user(profile) ya da admin sayfasına
        // girmeye calısırsa url den login sayfasına yönlendiriyor 
        // eğer ki kullanıcı girişi yapılırsa AppLoginAuthenticator.php de ki kullanıcı giriş yaptıysa
        // işlemlerin yapıldığı onAuthenticationSuccess fonksiyonu calısır ve orda yönlendirme yapılır


       // $aa = $this->getUser(); // giriş yaan kullanıcı verileini değişkene attık obje şeklinde geldi
        //echo '<pre>';
        //var_dump($aa); // getUser() daki verileri bastık
        //$bb = $aa->getRoles();  // bu şekile rolü aldık
        //$cc = $aa->getId(); // bu şekilde ıd yi aldık
       // $dd = $aa->getEmail(); // bu şekilde maili aldık
        //echo '<pre>';
       // var_dump($bb[0]); // Rol bir elemanlı dizi oldugu için 0. indisten rolü alıp yazdırdık
 
        // if ($bb[0]=='ROLE_USER') { // ifin içine giriyor sorun yok
        //  return $this->redirectToRoute('/profile');// kullanıcı giriş yaptıysa anasayfaya yönlenir 
                                                     // profile =  rotanın name ismi burdaki profile
                                                     // AppLoginAuthenticator.php deki onAuthenticationSuccess
                                                     // methoduna gidiyor eğer şu şekilde kullanırsak
                                                     // return $this->redirect rotanın url'ini yazıcaz                                       
        // }
        // else
        // {
        //    return $this->redirectToRoute('/home');
        // }
    }

    /**
     * @Route("/logout", name="app_logout")
     */
    public function logout()
    {
        throw new \LogicException('This method can be blank - it will be intercepted by the logout key on your firewall.');
    }


    /**
     * @Route("/signup", name="app_signup")
     */
    public function signup(Request $request, UserPasswordEncoderInterface $encoder): Response{ //üye kaydı kısmı aşagıdaki değerler
                                                                            // textlere girilen verilerden gelcek

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

        return new Response('User created !');

    }
}
