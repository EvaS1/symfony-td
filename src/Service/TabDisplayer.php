<?php

namespace App\Service;

use Twig\Extension\AbstractExtension;
use Twig\TwigFunction;

class TabDisplayer extends AbstractExtension {
	
	private $format;

	public function __construct($format) {
		$this->format = $format;
	}


	public function getFunctions() {
		return [
			new TwigFunction('tabDisp',[$this, 'getPrintedTab']),
		];
	}

	public function getPrintedTab($tableau) {


		if($this->format == "list") {
			$tab = '<ul>';
			foreach ($tableau as $cle=>$valeur) {
				$tab .='<li>'.$valeur.'</li>';				
			}
			$tab .='</ul>';

		} else if ($this->format == "paragraph") {
			$tab='<p>';
			foreach ($tableau as $cle=>$valeur) {
				$tab .= $valeur.' ';			
			}
			$tab .='</p>';
		}

		return $tab;
		
	}


}

?>

