<?php

namespace App\Controller\Admin;

use App\Entity\Bannermenu;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class EditPageController extends AbstractController
{
    #[Route('/admineditpage', name: 'admin_edit_page')]
    public function admineditpage(Request $request): Response
    {

        $em = $this->getDoctrine()->getManager();// veritabanı işlemleri için bunu yazıyoruz

        $bannerRepository = $em->getRepository(Bannermenu::class); // Url classının repository(sorguların oldugu sayfa)
                                                         // değişkene attık

        $banner_item = $bannerRepository->findBy([ // findBy ile koşula göre kayıtları getiriyoruz 
            'aktif'=>false // aktif(kolon adı) = true olan kayıtları aldık
        ]);

        $banner_itemsss = $bannerRepository->findBy([ // findBy ile koşula göre kayıtları getiriyoruz 
            'aktif'=>true // aktif(kolon adı) = true olan kayıtları aldık
        ]);
        
        return $this->render('admin/edit_page/editpage.html.twig', [
            'banner_items' => $banner_item, // iki değer gönderdik çünkü pasif olan sayfaları select kısmında
            'banner_itemsss' => $banner_itemsss // aktif olanları ise tablo içinde listeliyoruz
        ]);
    }

    #[Route('/admineditpasif/{id}', name: 'admin_edit_pasifpage')] // user pasif yapma
   public function admineditpasif($id, Request $request): Response
   {
       $em = $this->getDoctrine()->getManager();
       $editRepository = $em->getRepository(Bannermenu::class);
       $editdata = $editRepository->find($id);

       $editdata 
              ->setAktif(false);
       $em->persist($editdata);
       $em->flush();
       return $this->redirectToRoute('admin_edit_page');

   }

   #[Route('/admineditaktif/{id}', name: 'admin_edit_aktifpage')] // user aktif yapma
   public function admineditaktif($id, Request $request): Response
   {
    $em = $this->getDoctrine()->getManager();
    $editRepository = $em->getRepository(Bannermenu::class);
    $editdata = $editRepository->find($id);

    $editdata 
           ->setAktif(true);
    $em->persist($editdata);
    $em->flush();
    return $this->redirectToRoute('admin_edit_page');
   }
    
    #[Route('/terms', name: 'admin_edit_terms')]
    public function terms(): Response
    {
        return $this->render('admin/edit_page/terms.html.twig', [
            'controller_name' => 'TERMS',
        ]);
    }

    #[Route('/cookie', name: 'admin_edit_cookie')]
    public function cookie(): Response
    {
        return $this->render('admin/edit_page/cookie.html.twig', [
            'controller_name' => 'COOKİE',
        ]);
    }

    #[Route('/about', name: 'admin_edit_about')]
    public function about(): Response
    {
        return $this->render('admin/edit_page/about.html.twig', [
            'controller_name' => 'ABOUT',
        ]);
    }
}
