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
			new TwigFunction('tabDisp',[$this, 'getPrintedTab'], ['is_safe' => ['html']]),
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
		
		} else  if ($this->format == "tab") {
			$tab = '<table><tr>';
			foreach ($tableau as $cle=>$valeur) {
				$tab.='<th>'.$cle.'</th>';
				$tab.='<td>'.$valeur.'</td></tr>';
			}
            $tab.='</table>';
		}

		return $tab;
		
	}


}

?>

