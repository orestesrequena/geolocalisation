<?php

namespace App\Controller;

use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Security\Http\Authentication\AuthenticationUtils;

use GeoIp2\Database\Reader;
use GeoIp2\Exception\AddressNotFoundException;

use App\Entity\Client;
use App\Form\ClientType;

use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Mailgun\Mailgun;


class AppController extends Controller
{

     /**
     * @Route("/", name="form")
     */
    public function index(Request $request)
    {

         // Declare the path to the GeoLite2-City.mmdb file (database)
         $GeoLiteDatabasePath= $this->get('kernel')->getRootDir() . '/GeoLite2-City/GeoLite2-City.mmdb';
      
         // Create an instance of the Reader of GeoIp2 and provide as first argument
         // the path to the database file
         $reader = new Reader($GeoLiteDatabasePath );
         
         try{
             // if you are in the production environment you can retrieve the
             // user's IP with $request->getClientIp()
             // Note that in a development environment 127.0.0.1 will
             // throw the AddressNotFoundException
           
 
             // In this example, use a fixed IP address in Minnesota
             //$records = $reader->city('128.101.101.101');
           
             //$ip = $request->getClientIp();
             if (!empty($_SERVER['HTTP_CLIENT_IP'])) {
                $ip = $_SERVER['HTTP_CLIENT_IP'];
            } elseif (!empty($_SERVER['HTTP_X_FORWARDED_FOR'])) {
                $ip = $_SERVER['HTTP_X_FORWARDED_FOR'];
            } else {
                $ip = $_SERVER['REMOTE_ADDR'];
            }
           
        
             $records = $reader->city($ip);
           
         } catch (AddressNotFoundException $ex) {
             // Couldn't retrieve geo information from the given IP
             return new Response("Ce n'est pas possible de trouver votre IP");
         }
     
         //$ville = $records->city->name ;
         $region = $records->mostSpecificSubdivision->name;
         $pays =  $records->country->name;
        
      
         $em = $this->getDoctrine()->getManager();
        
            // creates a client 
            $client = new Client();
            $client->setNom("");
            $client->setDateNaissance(new \DateTime('tomorrow'));
            $client->setPays($pays);
            $client->setRegion($region);

        $form = $this->createForm(ClientType::class, $client);

        //envoi de formulaire

        if ($request->isMethod('POST') && $form->handleRequest($request)->isValid()) {

            $client->setNom($client->getNom());
            $client->setPrenom($client->getPrenom());
            $client->setDateNaissance($client->getDateNaissance());
            $client->setEmail($client->getEmail());
            $client->setSexe($client->getSexe());
            $client->setPays($client->getPays());
            $client->setRegion($client->getRegion());
            $client->setMetier($client->getMetier());
           
         
            $emailForm= $client->getEmail();
            $nomForm = $client-getNom();
           
   
            $email = new \SendGrid\Mail\Mail(); 
            $email->setFrom("test@example.com", "User Admin");
            $tos = [ 
                "orestes64@gmail.com" => "User Client",
                 $emailForm => "User Client2",
            ];
            $email->addTos($tos);
            
            $email->setSubject("Confirmation de l'envoi du formulaire" );
         
            $email->addContent(
                "text/html", $this->renderView(
                    'emails/emailClient.html.twig',
                    ['email' => $emailForm,
                     'nom' => $nomForm,
                      ]
                    )
            );

            $sendgrid = new \SendGrid(getenv('SENDGRID_API_KEY'));
            try {
                $response = $sendgrid->send($email);
                print $response->statusCode() . "\n";
                print_r($response->headers());
                print $response->body() . "\n";
            } catch (Exception $e) {
                echo 'Caught exception: ',  $e->getMessage(), "\n";
            }

          $em->persist($client);
          $em->flush();
    
          return $this->redirectToRoute('form');
        }
   

        return $this->render('app/index.html.twig', array(
            'region' => $region,
            'pays' =>$pays,
            'form' => $form->createView(),
        ));
    }


}


