<?php

namespace App\Service;

class TabDisplayer {
	
	private $format;

	public function __construct($format) {
		$this->format = $format;
	}


	public function getPrintedTab($tableau) {
		

		if($this->format == "list") {
			foreach ($tableau as $valeur) {
				$tab ='<ul>
				<li>'.$valeur.'</li>
				</ul>';
				return $tab;				
			}

		} else if ($this->format == "paragraph") {
			foreach ($tableau as $valeur) {
				$tab = '<p>'.$valeur.' '.'</p>';
				return $tab;
			}
		}
		
	}


}

?>

