<?php

declare(strict_types=1);

namespace Account\player;

use DataBase\provider\SQL;
use Account\event\AccountChangeDataEvent;
use Account\utils\JsonMapper;
use Account\utils\JsonObject;

class AccountSource
{

	public JsonObject $jsonStream;

	public function __construct(AccountEntry $accountEntry) {
		$this->accountEntry = $accountEntry;
	}

	public function getData(): JsonObject {
		return $this->jsonStream;
	}

	public function update(?string $reason = null): void {
		if(!is_null($reason)) {
			(new AccountChangeDataEvent($this->player, $reason))->call();
		}
		SQL::getDatabase()->query("UPDATE `accounts` SET `json` = '".json_encode($this->jsonStream)."' WHERE `nickname` = '".strtolower($this->player->getName())."'");
	}

	public function init(): bool {
		$rows = SQL::getDatabase()->query("SELECT *  FROM `accounts` WHERE `nickname` = '".strtolower($this->accountEntry->getName())."'")->fetch_assoc();

		if($rows !== null) {
			$this->accountEntry->setName($rows["nickname"]);
			$this->jsonStream = (new JsonMapper)->map(json_decode($rows["json"], true), new JsonObject());

			return true;
		} else {
			return false;
		}

	}

}