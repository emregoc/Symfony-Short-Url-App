<?php

namespace App\Controller\Admin;

use App\Entity\Url;
use App\Entity\User;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class AdminuserController extends AbstractController
{
    #[Route('/adminuser', name: 'admin_user_page')]
    public function index(): Response
    {
        $em = $this->getDoctrine()->getManager();

        $userRespository = $em->getRepository(User::class);//$em ile AbstractController extend oldugundan getRepository fonksiyonuna 
                                               // entity classımızı parametre olarak gönderdik. Yani user classımız
        $user_items = $userRespository->findAll(); //herhangi bir koşula bağlı olmaksızın findall() tüm kayıtları getirir
                                                // ve bu değerleri $user_items değişkenine attık

        //$user_items = $urlRespository->findBy(['is_active'=>false]); // bu şekilde is_active = 0 olanları listeler
                                                                      // true yaparsak is_active=1 olanları listeler


        return $this->render('admin/admin/adminuser.html.twig', [
            'controller_name' => 'AdminuserController',
            'user_items' => $user_items //$user_items daki verileri 'user_items' keyine attık ve twig tarafında bu key ile
                                      // verileri alıp listeleyebilcez
        ]);
    }

    #[Route('/adminuserupdatelist/{id}', name: 'admin_user_updatepagelist')]#adminuser.index.twigten gönderdiğimiz idyi aldık
   public function adminuserupdatelist(Request $request, User $users): Response // user entity deki verileri aldık
   {

    
        // burda fonksiyonda id yi göre veriyi listeleyip aşagıdaki adminurlupdate fonksiyonla da güncelliyoruz

       return $this->render('admin/admin/adminuserupdatelist.html.twig', [ 
                                                                      
                                                                      
            'user' => $users, // parametredeki değişken  
                                                               
        ]);
       
   }

   #[Route('/adminuserupdate/{id}', name: 'admin_user_update')] // admin user güncelleme
   public function adminuserupdate($id, Request $request): Response
   {    
       $email = $request->request->get('email');//inputlardaki name adları
       $roles[] = $request->request->get('roles');//inputlardaki name adları, User entitiy içindeki role 
                                                 // array oldugu için burdada gelen değeri arraye attık
       $em = $this->getDoctrine()->getManager();
       $userRepository = $em->getRepository(User::class);

       $userdata = $userRepository->find($id);

       $userdata
            ->setEmail($email)
            ->setRoles($roles);

        $em->persist($userdata);
        $em->flush();
        return $this->redirectToRoute('admin_user_page');

   }

   #[Route('/adminuserdelete/{id}', name: 'admin_user_deletepage')]// url delete
   public function adminuserdelete($id, Request $request): Response
   {
       $em = $this->getDoctrine()->getManager();
       $userRepository = $em->getRepository(User::class);
       $userdeleteid = $userRepository->find($id);

       if(!$userdeleteid)
       {
           return $this->createNotFoundException('User Bulunamadı');
       }

       $em->remove($userdeleteid);
       $em->flush();

       return $this->redirectToRoute('admin_user_page');

   }

   #[Route('/adminuserpasif/{id}', name: 'admin_user_pasifpage')] // user pasif yapma
   public function adminuserpasif($id, Request $request): Response
   {
       $em = $this->getDoctrine()->getManager();
       $userRepository = $em->getRepository(User::class);
       $userdata = $userRepository->find($id);

       $userdata 
              ->setIsActive(false);
       $em->persist($userdata);
       $em->flush();
       return $this->redirectToRoute('admin_user_page');

   }

   #[Route('/adminuseraktif/{id}', name: 'admin_user_aktifpage')] // user aktif yapma
   public function adminurlaktif($id, Request $request): Response
   {
    $em = $this->getDoctrine()->getManager();
    $userRepository = $em->getRepository(User::class);
    $userdata = $userRepository->find($id);

    $userdata 
           ->setIsActive(true);
    $em->persist($userdata);
    $em->flush();
    return $this->redirectToRoute('admin_user_page');
   }
}
