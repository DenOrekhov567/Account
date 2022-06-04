<?php

declare(strict_types=1);

namespace Account\player;

class AccountEntry
{

    private string $name;

	public function __construct(string $name) {
		$this->name = $name;
	}

	public function getName(): string {
		return $this->name;
	}

    public function setName($name): void {
		$this->name = $name;
	}

}