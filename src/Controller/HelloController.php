<?php
// le namespace des controllers sera toujours le même
namespace App\Controller;

// La classe Response nous sert pour renvoyer la réponse (voir après)
use Symfony\Component\HttpFoundation\Response;
// la classe Controller est la classe mère de tous les controllers
use Symfony\Bundle\FrameworkBundle\Controller\Controller;

// notre controller doit forcément hériter de la classe Controller ("use" ci-dessus)
// Le nom de la classe doit être exactement le même que celui du fichier
class HelloController extends Controller
{
    public function index()
    {
        // on renvoie ici un texte simple. Une instance de Response doit toujours être renvoyée.
	    $prenom = "Sylvain";
	    $prenom1 = "Emma";
	    $prenom2 = "Eva";	
	    $age = 23;

		$tableau_prenoms = array("Sylvain", "Emma", "Eva");

		return $this->render('hello.html.twig', array(
		 	"tableau_prenoms" => $tableau_prenoms
		));
	}

	public function index_perso($prenom, $age)
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
	}


}




?>