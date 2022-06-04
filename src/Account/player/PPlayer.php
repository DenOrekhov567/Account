<?php

declare(strict_types=1);

namespace Account\player;

use pocketmine\player\Player;

class PPlayer extends Player
{

	private $account;

	public function initAccount(): void {
		is_null($this->account) ? $this->account = new Account($this) : null;
	}

	public function initEntity(\pocketmine\nbt\tag\CompoundTag $nbt): void {
		var_dump("123");

		$this->initAccount();

		parent::initEntity($nbt);
	}

	public function getAccount(): ?Account {
		return $this->account;
	}

}