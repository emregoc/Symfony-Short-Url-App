<?php

namespace App\Controller\Admin;

use App\Entity\Message;
use App\Entity\Url;
use App\Entity\UrlStats;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Form\Extension\Core\Type\UrlType;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class AdminController extends AbstractController
{
   #[Route('/admin', name: 'admin_admin')] // urlstats tablosundaki verileri listeledik burda
    public function index(): Response
    {
        $em = $this->getDoctrine()->getManager();

        $urlRespository = $em->getRepository(UrlStats::class);//$em ile AbstractController extend oldugundan getRepository fonksiyonuna 
                                               // entity classımızı parametre olarak gönderdik. Yani Url classımız
        $url_items = $urlRespository->findAll(); //herhangi bir koşula bağlı olmaksızın findall() tüm kayıtları getirir
                                                // ve bu değerleri $url_items değişkenine attık

        //$url_items = $urlRespository->findBy(['is_active'=>false]); // bu şekilde is_active = 0 olanları listeler
                                                                      // true yaparsak is_active=1 olanları listeler

        return $this->render('admin/admin/index.html.twig', [
            'controller_name' => 'AdminController',
            'url_items' => $url_items //$url_items daki verileri 'url_items' keyine attık ve twig tarafında bu key ile
                                      // verileri alıp listeleyebilcez
        ]);
    }
    
    #[Route('/admin/message', name: 'admin_message_page')]
    public function adminmessage(): Response
    {
     
         $em = $this->getDoctrine()->getManager();
         $urlRespository = $em->getRepository(Message::class);
         
         $message_items = $urlRespository->findAll();
 
        // $url_items = $urlRespository->findBy(['url']);
         
         return $this->render('admin/admin/adminmessage.html.twig', [
                 'message_items' => $message_items
         ]);
    }

   #[Route('/adminurl', name: 'admin_url_page')]
   public function adminurl(): Response
   {
    
        $em = $this->getDoctrine()->getManager();
        $urlRespository = $em->getRepository(Url::class);
        
        $url_items = $urlRespository->findAll();

       // $url_items = $urlRespository->findBy(['url']);
        
        return $this->render('admin/admin/adminurl.html.twig', [
                'adminurl_items' => $url_items
        ]);
   }
   #[Route('/adminurlupdatelist/{id}', name: 'admin_url_updatepagelist')]#adminurl.index.twigten gönderdiğimiz idyi aldık
   public function adminurlupdatelist(Request $request, Url $urls): Response // Url entity deki verileri aldık
   {

       // $form = $this->createForm(UrlType::class, $urls);
        //$form->handleRequest($request);
        
       // if($form->isSubmitted() && $form->isValid())
        //{

          //  $this->getDoctrine()->getManager()->flush();
         // return $this->redirectToRoute('admin_url_page');

       // }

    
        // burda fonksiyonda id yi göre veriyi listeleyip aşagıdaki adminurlupdate fonksiyonla da güncelliyoruz

       return $this->render('admin/admin/adminurlupdatelist.html.twig', [ // eğer form submit olmadıysa burası calısır
                                                                      // verileri admin/admin/adminurlupdate.html.twig
                                                                      // sayfasına gönderir
            'url' => $urls, // parametredeki değişken  
                                                               
        ]);
       
   }

   #[Route('/adminurlupdate/{id}', name: 'admin_url_update')] // url güncelleme
   public function adminurlupdate($id, Request $request): Response
   {    
       $url = $request->request->get('url');//inputlardaki name adları
       $hash = $request->request->get('hash');//inputlardaki name adları
       $em = $this->getDoctrine()->getManager();
       $urlRepository = $em->getRepository(Url::class);

       $urldata = $urlRepository->find($id);

       $urldata
            ->setUrl($url)
            ->setUrlHash($hash);

        $em->persist($urldata);
        $em->flush();
        return $this->redirectToRoute('admin_url_page');

   }

   #[Route('/adminurldelete/{id}', name: 'admin_url_deletepage')]// url delete
   public function adminurldelete($id, Request $request): Response
   {
       $em = $this->getDoctrine()->getManager();
       $urlRepository = $em->getRepository(Url::class);
       $urldeleteid = $urlRepository->find($id);

       if(!$urldeleteid)
       {
           return $this->createNotFoundException('Url Bulunamadı');
       }

       $em->remove($urldeleteid);
       $em->flush();

       return $this->redirectToRoute('admin_url_page');

   }

   #[Route('/adminurlpasif/{id}', name: 'admin_url_pasifpage')] // url pasif yapma
   public function adminurlpasif($id, Request $request): Response
   {
       $em = $this->getDoctrine()->getManager();
       $urlRepository = $em->getRepository(Url::class);
       $urldata = $urlRepository->find($id);

       $urldata 
              ->setIsActive(false);
       $em->persist($urldata);
       $em->flush();
       return $this->redirectToRoute('admin_url_page');

   }

   #[Route('/adminurlaktif/{id}', name: 'admin_url_aktifpage')] // url aktif yapma
   public function adminurlaktif($id, Request $request): Response
   {
    $em = $this->getDoctrine()->getManager();
    $urlRepository = $em->getRepository(Url::class);
    $urldata = $urlRepository->find($id);

    $urldata 
           ->setIsActive(true);
    $em->persist($urldata);
    $em->flush();
    return $this->redirectToRoute('admin_url_page');
   }
}
