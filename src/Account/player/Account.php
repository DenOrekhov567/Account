<?php

declare(strict_types=1);

namespace Account\player;

use DataBase\provider\SQL;
use Account\utils\JsonObject;

class Account extends AccountSource
{

	public PPlayer $player;

	public function  __construct(PPlayer $player) {
		parent::__construct(new AccountEntry($player->getName()));

		$this->player = $player;

		$this->init();
	}

	public function register(): void {
		$this->jsonStream = new JsonObject();
		$this->jsonStream->xuid = $this->player->getXuid();

		SQL::getDatabase()->query("INSERT INTO `accounts`(`nickname`, `json`) VALUES ('".strtolower($this->player->getName())."', '".json_encode($this->getData())."')");
	}

	public function authorize(): void {
		
	}

	public function init(): bool {
		if($this->player->getXuid() != "") {
			if(!parent::init()) {
				$this->register();

				$this->player->sendMessage("Ты был зарегистрирован!");
			} else {
				if($this->player->getXuid() === $this->player->getData()->xuid) {
					$this->authorize();

					$this->player->sendMessage("Ты был авторизирован!");
				} else {
					$this->player->kick("Your XUID does not match the account's XUID!");
				}

			}

		} else {
			$this->player->kick("To play on the server you need to be authenticated in XUID!");
		}
		return true;
	}

}