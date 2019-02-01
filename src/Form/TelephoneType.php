<?php

namespace App\Form;

use App\Entity\Telephone;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\NumberType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;

//une classe Type hérite toujours de la classe abstraite AbstractType
class TelephoneType extends AbstractType {

	//$builder correspond au FormBuilder
	//$options sont les options passées au moment de la création du Form dans le contrôleur createForm
	//Le troisième argument est facultatif
	//Selon ces options, on peut créer un formulaire avec un label différent, un champ en plus ou en moins...
	public function buildForm(FormBuilderInterface $builder, array $options) {
		$builder
		->add('marque') //Symfony retrouve le type à partir de l'entité)
		->add('type')
		->add('taille')
		->add('save', SubmitType::class, array('label' => 'Création'))
		;
	}


	//Spécifications des options obligatoires/facultatives. Cette function est hautement paramétrable si besoin
	public function configureOptions(OptionsResolver $resolver) {

		//Nous spécifions ici que le paramètre que nous utilisons dans la fonction createForm du contrôleur doit être une entité Téléphone, cela permet à Symfony de pouvoir retrouver le type des champs du formulaire
		$resolver->setDefaults([
			'data_class' => Telephone::class,
		]);

	}

}


?>