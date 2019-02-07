<?php
// le namespace des controllers sera toujours le même
namespace App\Controller;

// La classe Response nous sert pour renvoyer la réponse (voir après)
use Symfony\Component\HttpFoundation\Response;
// la classe Controller est la classe mère de tous les controllers
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Psr\Log\LoggerInterface;
use App\Service\SweatMessageGenerator;

// notre controller doit forcément hériter de la classe Controller ("use" ci-dessus)
// Le nom de la classe doit être exactement le même que celui du fichier
class HelloController extends Controller
{
    public function index(LoggerInterface $logger, SweatMessageGenerator $message)
    {
        // on renvoie ici un texte simple. Une instance de Response doit toujours être renvoyée.
	    $prenom = "Sylvain";
	    $prenom1 = "Emma";
	    $prenom2 = "Eva";	
	    $age = 23;

	    $logger->info("Mon joli log");

	    $message->getSweatMessage();

		$tableau_prenoms = array("Sylvain", "Emma", "Eva");

		return $this->render('hello.html.twig', array(
		 	"tableau_prenoms" => $tableau_prenoms,
		 	"message" => $message->getSweatMessage(),
		));



	}

/*	public function index_perso($prenom, $age)
	{
	    return $this->render('hello.html.twig', array(
	        "prenom" => $prenom,
	       	"age" => $age,
	    ));
        
	    
	}

	public function index_erreur($prenom) {
		return $this->render('erreur.html.twig', array(
        	"prenom" => $prenom,
        ));
	}*/


	/*Envoi d'un email*/
	/*public function index($name, \Swift_Mailer $mailer) {
		$message = (new \Swift_Message('Hello Email'))
			->setFrom('eva.saintier@gmail.com')
			->setTo('eva3105@orange.fr')
			->setBody(
				$this->renderView(
					'emails/registration.html.twig',
					['name' => $name]
				),
				'text/html'
			)

			/*Pour inclure une version en plaintext 
			->addPart(
				$this->renderView(
					'emails/registration.txt.twig',
					['name' => $name]
				),
				'text/plain'
			)*/

			/*;

			$mailer->send($message);

			return $this->render('emails/registration.html.twig', array("name" => $name,
		));

	}
*/

	

}




?>