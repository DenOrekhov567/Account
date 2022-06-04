<?php

declare(strict_types=1);

namespace Account\event;

use pocketmine\event\player\PlayerEvent;

use Account\player\PPlayer;

class AccountChangeDataEvent extends PlayerEvent
{

	public string $reason;

	public function __construct(PPLayer $player, string $reason) {
		$this->player = $player;
		$this->reason = $reason;
	}

	public function getReason(): string {
		return $this->reason;
	}

}