<?php

namespace App\Service;

class SweatMessageGenerator {
	public function getSweatMessage() {
		$messages = [
			'Merci à toi !',
			'Belle journée, n\'est-ce pas ?',
			'Ca fait plaisir de te voir !',
			'Tu es tellement formidable !',
		];

		$index = array_rand($messages);

		return $messages[$index];
	}
}


?>