<?php

namespace App\Service;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Console\Input\InputArgument;

class SweatMessageGenerator extends Command {
	
	private $idMessage;

	public function __construct() {
		/*$this->idMessage = $idMessage;*/

		parent::__construct();
	}

	protected function configure() {
		$this
			->setName('app:sweetmessage')
			->setDescription('A sweet message for you !')
			->setHelp('You need to have a sweet moment. Use this service ! :D');

		$this->addArgument('idMessage', InputArgument::OPTIONAL, 'L\'id du message');
	}


	protected function execute(InputInterface $input, OutputInterface $output) {
		$this->idMessage = $input->getArgument('idMessage');
		$output->writeln($this->getSweatMessage());
		
	}


	public function getSweatMessage() {
		dump($this->idMessage);
		$messages = [
			'Merci à toi !',
			'Belle journée, n\'est-ce pas ?',
			'Ca fait plaisir de te voir !',
			'Tu es tellement formidable !',
		];

		if($this->idMessage != "") {
			$index = $this->idMessage;
		} else {
			$index = array_rand($messages);
		}		

		return $messages[$index];
	}

}


?>