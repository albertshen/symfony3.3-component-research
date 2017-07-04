<?php

namespace Symfony\Component\DependencyInjection;

class Person
{
	private $identity;

	public function __construct(Identity $identity)
	{
		$this->identity = $identity;
	}

	public function setIdentity(Identity $identity)
	{
		$this->identity = $identity;
	}

	public function getIdentity()
	{
		return $this->identity;
	}
}
