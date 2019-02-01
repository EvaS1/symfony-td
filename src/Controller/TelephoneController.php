<?php
// le namespace des controllers sera toujours le même
namespace App\Controller;

// La classe Response nous sert pour renvoyer la réponse (voir après)
use Symfony\Component\HttpFoundation\Response;
// la classe Controller est la classe mère de tous les controllers
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use App\Entity\Telephone;
use Symfony\Component\HttpFoundation\Request;
use App\Form\TelephoneType;



// notre controller doit forcément hériter de la classe Controller ("use" ci-dessus)
// Le nom de la classe doit être exactement le même que celui du fichier
class TelephoneController extends Controller
{
    /*public function index_tel() {
    	$tel = new Telephone();
		$tel->setMarque('Nokia');
		$tel->setType('8');
		$tel->setTaille(5.3);
		$em = $this->getDoctrine()->getManager();
		$em->persist($tel);
		$em->flush();
		$tel->getId();
		$tel2 = $this->getDoctrine()->getRepository(Telephone::class)->find(2);
    }*/

    /*Insertion nouveau téléphone depuis url*/
    public function index_new_tel($marque, $type, $taille) {
    	$tel = new Telephone();
		$tel->setMarque($marque);
		$tel->setType($type);
		$tel->setTaille($taille);
		$em = $this->getDoctrine()->getManager();
		$em->persist($tel);
		$em->flush(); 
    }

    /*Modification téléphone depuis url*/
   /* public function index_modify_tel($id, $marque, $type, $taille) {    	
    	$em = $this->getDoctrine()->getManager();
    	$tel = $em->getRepository(Telephone::class)->find($id); 
    	$tel->setMarque($marque);
		$tel->setType($type);
		$tel->setTaille($taille);
    	$em->persist($tel);
		$em->flush();
    }*/
    
    /*Suppression téléphone depuis url*/
    public function index_delete_tel($id) {
    	$em = $this->getDoctrine()->getManager();
    	$tel = $em->getRepository(Telephone::class)->find($id); 
    	$em->remove($tel);
		$em->flush();
    } 

    /*Récupération téléphones*/
    public function index() {
    	$repo = $this->getDoctrine()->getRepository(Telephone::class);
        $tableau_tel = $repo ->findAll();
        return $this->render('tel.html.twig', array(
            "tableau_tel" => $tableau_tel
		));
    }

    /*Récupération téléphones les plus grands*/
    public function index_grands_tel() {
        // appel dans le contrôleur
        $repo = $this->getDoctrine()->getRepository(Telephone::class);
        $grands_tel = $repo->findBiggerSizeThan(5.5);

        return $this->render('grands_tel.html.twig', array(
            "grands_tel" => $grands_tel
        ));
    }

    /*Recherche par marque*/
    public function index_search_tel($search) {
        $repo = $this->getDoctrine()->getRepository(Telephone::class);
        $search_tel = $repo->findBrand($search);

        return $this->render('marque_tel.html.twig', array(
            "search_tel" => $search_tel
        ));
    }

    /*Recherche par marque QueryBuilder*/
    public function index_advanced_search_tel($searchMarque, $searchType) {
        $repo = $this->getDoctrine()->getRepository(Telephone::class);
        $advanced_search_tel = $repo->findBrandQb($searchMarque, $searchType);

        return $this->render('recherche_avancee_tel.html.twig', array(
            "advanced_search_tel" => $advanced_search_tel
        ));
    }


    /*Formulaire de création de téléphone*/
    public function new(Request $request) {

        //Nous créons une entité Telephone
        $tel = new Telephone();


        //Nous créons un formulaire A PARTIR de $tel, ce qui permettra à Symfony d'hydrater (remplir) cette entité quand le formulaire sera validé
        /*$form = $this->createFormBuilder($tel);

        //c'est pour cette raison qu'on a des noms de champs qui correspondent à l'entité : Symfony les reconnait et fait le lien directement
        //Nous précisons aussi le type de champs (TextType::class)

        ->add('marque', TextType::class)
        ->add('type', TextType::class)
        ->add('taille', NumberType::class)

        //On créée le bouton de sauvegarde, sur lequel nous écrivons "Création"
        ->add('save', SubmitType::class, array('label' => 'Création'))

        //La ligne suivante permet de créer l'objet formulaire en lui-même
        ->getForm();*/
        
        // => Grâce à TelephoneType.php, on remplace les lignes précédentes par celle-ci :
        $form = $this->createForm(TelephoneType::class, $tel);


        //Nous récupérons ici les informations du formulaire validé, c-à-d l'équivalent du $_POST, grâce à l'objet $request. Il représente les infos sur la requête HTTP reçue.
        $form->handleRequest($request);


        //Si nous venons de valider le formulaire et s'il est valide (problèmes de type, etc), on enregistre l'objet $tel, qui a été hydraté grâce au paramètre donné à la méthode createFormBuilder
        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($tel);
            $em->flush();

            //On redirige l'utilisateur vers la route /telephone/ grâce à l'identifiant du fichier yaml, ce qui permet, en cas de changement d'url, de ne modifier que le yaml
            return $this->redirectToRoute('telephone_recupere_index');
        }


        //On envoie vers Twig
        return $this->render('telephone/new.html.twig', array(
            'form' => $form->createView(),
        ));

    }


    /*Formulaire de modification de téléphone*/
    public function modify($id) {

    }


        
}

?>