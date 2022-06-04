<?php

declare(strict_types=1);

namespace Account;

use pocketmine\event\Listener;

use pocketmine\event\player\PlayerCreationEvent;
use pocketmine\event\player\PlayerInteractEvent;

use Account\player\PPlayer;

class EventListener implements Listener
{
	
    public function onPlayerCreation(PlayerCreationEvent $event): void {
		$event->setBaseClass(PPlayer::class);
		$event->setPlayerClass(PPlayer::class);
	}

}