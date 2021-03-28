<?php
namespace App\Controller;

use App\Entity\Bannermenu;
use App\Entity\Homepage;
use App\Entity\Url;
use App\Entity\User;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;

class HomeController extends AbstractController
{
    #[Route('/', name: 'home')]
    public function index(): Response
    {
        # TODO : GET CMS data from RDBMS DB
        #listeleme yapıyoruz ana sayfadaki yazılar ve resimler için ve sonra verileri home/index.html.twige gönderiyoruz
        
        $em = $this->getDoctrine()->getManager();

        $homepageRepository = $em -> getRepository(Homepage::class);

        $page_items = $homepageRepository->findAll();

        //alttaki 3 komut sayesinde verileri foreacha sokmadan listeleyebiliriz
        //$settings= $repo->find(1); // 1 id var zaten onu çek
        //return $this->render('home/index.html.twig', ['features'=>$features]); // render ettiğimiz kısım
        //{{ settings.banner }} twig tarafında böyle yazıp kullanabilirsin

        $bannermenuRepository = $em -> getRepository(Bannermenu::class);

        $bannermenu_items = $bannermenuRepository->findBy([ // findBy ile koşula göre kayıtları getiriyoruz 
            'aktif'=>true // aktif(kolon adı) = true olan kayıtları aldık
        ]);

        return $this->render('home/index.html.twig', [
            'page_items' => $page_items, // anasayfadaki resimler ve yazıları gönderiyoruz twige
            'bannermenu_items' =>  $bannermenu_items // ana sayfadaki banner menüsünü gönderiyoruz
        ]);
    }


}
