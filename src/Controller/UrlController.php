<?php

namespace App\Controller;

use App\Entity\Url;
use App\Entity\UrlStats;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\PropertyAccess\PropertyAccess;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Validator\Validator\ValidatorInterface;
use Symfony\Component\Validator\Constraints as Assert;

class UrlController extends AbstractController
{

    #[Route('/url/create', name: 'url_create')]
    public function create(Request $request, ValidatorInterface $validator): Response
    {

        $url = $request->get('url');
        $shortUrl = null;

        $name = 'volkan';
        $email = 'testemail_adresi';

        # url validation
        $constraints = new Assert\Collection([
            #'name' => [ new Assert\Length(['min'=>10]), new Assert\Length(['max'=>12]) ],
            #'email' => [ new Assert\Email()],
            'url' => [ new Assert\Url() ]
        ]);

        $violations = $validator->validate([
            #'name'=>$name,
            #'email'=>$email,
            'url'=>$url
        ], $constraints);

        $accessor = PropertyAccess::createPropertyAccessor();
        $errorMessages = [];

        foreach($violations as $v){
            $accessor->setValue($errorMessages, $v->getPropertyPath(), $v->getMessage() );
        }

        if (count($errorMessages)===0){
            # generate 5 digit hash
            $alpha_numeric = '0123456789ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz';
            $url_hash = substr( str_shuffle($alpha_numeric),0,5);

            $em = $this->getDoctrine()->getManager();

            $url_item = new Url(); // url classı içindekilere yani Entity(kolonlara) ulastık ve değişkene attık
            $url_item->setUrl($url)
                ->setUrlHash( $url_hash )
                ->setCreatedAt( (new \DateTime()) )
                ->setClickCount(0)
                ->setIsPublic(true)
                ->setExpiredAt(( new \DateTime() ))
                ->setIsActive(true);
                $user_id=$this->getUser()->getId(); // giriş yapan kişinin ıd sini aldık

                if(is_null($user_id)) // id boşsa 
                {
                    $url_item->setUserId(0); // url tablosundaki setuserıd ye 0 attık
                }
                else{ // id doluysa
                    $url_item->setUserId($user_id); // giriş yapan kişinin id sini url tablosundaki setuserıd ye attık
                }
            $em->persist($url_item);
            $em->flush();

            $shortUrl = 'http://pa.th/'.$url_hash;
        }


        return new JsonResponse([
            'success'=>count($errorMessages)===0??false,
            'response'=>$shortUrl,
            'error'=>count($errorMessages)>0??false,
            'errorMessage'=>count($errorMessages)>0?$errorMessages:null
        ],200);

    }


    #[Route('/{urlHash}', name: 'redirector')] // localhost:4000/{urlHash}'i yazarsak ilgili linke gider                             
    public function redirector($urlHash, Request $request): Response
    {
        $em = $this->getDoctrine()->getManager();// veritabanı işlemleri için bunu yazıyoruz

        $urlRepository = $em->getRepository(Url::class); // Url classının repository(sorguların oldugu sayfa)
                                                         // değişkene attık

        $url_item = $urlRepository->findOneBy([ // findOneBy ile bir tane kayıt getiriyoruz 
            'is_active'=>true, // is_active(kolon adı) = true olan kaydı ve yukarda rotada {urlHash}'e gelen değeri
            'urlHash'=>$urlHash // fonksiyondaki $urlHash ile alıyoruz ve o url hashe ait kaydı getiriyor
        ]);

        if ($url_item){ // eğer $url_item var ise yani url imiz var ise
            $url = $url_item->getUrl(); // getUrl gidiceğimiz adres yani kısaltılan adres
            $urlId = $url_item->getId(); // getId url'in ıd si

            $this->saveStats($urlId, $request); // url'imiz var ise istatistikleri saveStats methotuna gönderip 
                                                // veritabanına UrlStats tablosuna kaydediyoruz
                                                

            return $this->redirect($url); // daha sonra yönlendirmeyi yapıyoruz
        }

        return $this->redirectToRoute('home'); // bulunmayan url geldiyse ana sayfaya yönlendir
    }

    public function saveStats($urlId, Request $request){ // Request classı sayesinde bir çok bilgiye erişebiliyoruz
        
       // print_r($request->headers); burada cookie bilgilerini falan alabiliyoruz hangi tarayıcıdan baglandıgı falan
        // exit();
        $userAgent = $request->headers->get('User-Agent'); //User-Agent ile hangi tarayıcıdan hangi işletim
                                                           // sisteminden falan baglandıgını aldık
        $clientIp = $request->getClientIp(); // burdada ip yi localde aldıgı için ::1 yazıyor fakat local dışında
                                             // normal ıp yi yazar


      $ip = '88.242.67.210'; // kendi ip adresim
    $result = json_decode(file_get_contents("http://ipinfo.io/{$ip}")); // ip adresine göre şehir ülke vs. bilgileri
                                                                        // cektik ve asagıda yazdık şehir ve ülkede
         
         //var_dump($result); // bu şekildede başka neleri yazabiliriz görebiliyoruz

        $em = $this->getDoctrine()->getManager();

        $url_stats = new UrlStats(); //urlStats classı içindekilere yani Entity(kolonlara) ulastık 
                                     // ve değişkene attık
        $url_stats->setUrlId($urlId)// redirector fonksiyonu içinde ifin içindeki bu fonksiyona(saveStats) 
                                    //gönderilen urlId
            ->setBrowser($userAgent)
            ->setIpAddress($clientIp)
            ->setDevice('-') // cihazı da çözünürlükle birlikte yakalyıp al
            ->setResolution('-') // çözünürlük bunu javascriptle alıcan
            ->setLocale('tr') // $request->headers->get(''); ile bunu alabiliriz Request classının içinde var
            ->setCity($result->city)
            ->setCountry($result->country)
            ->setCreatedAt( ( new \DateTime() ));

        $em->persist($url_stats);
        $em->flush();
    }


}
