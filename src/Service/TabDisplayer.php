<?php

namespace App\Service;

class TabDisplayer {
	
	private $format;

	public function __construct($format) {
		$this->format = $format;
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

