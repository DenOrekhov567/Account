<?php

declare(strict_types=1);

namespace Account\utils;

use pocketmine\Server;
use pocketmine\player\Player;
use Account\player\AccountSource;
use Account\player\AccountEntry;
use DataBase\provider\SQL;

class Utils
{

	public static function getAccount(string $nickname): ?AccountSource {
		$player = Server::getInstance()->getPlayerByPrefix($nickname);
		if($player instanceof Player) {
			return $player->getAccount();
		} else {
			if(self::issetAccount(new AccountEntry($nickname))) {
				$account = new AccountSource(new AccountEntry($nickname));
				$account->init();
				return $account;
			}

		}
		return null;
	}

	public static function issetAccount(AccountEntry $entry): bool {
		$rows = SQL::getDatabase()->query("SELECT * FROM `accounts` WHERE `nickname` = '{$entry->getName()}'");

		if($rows == null || $rows->num_rows <= 0) {
			return false;
		}
		return true;
	}

}