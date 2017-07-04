<?php

namespace Symfony\Component\DependencyInjection;

class Identity
{
	private $identity = array();

	public function __construct($name = 'albertshen')
	{
		$this->identity['husbund'] = $name;
	}

	public function addIdentity($id, $name)
	{
		return $this->identity[$id] = $name;
	}

	public function getIdentity($name)
	{
		if(!isset($this->identity[$name])) {
			throw new RuntimeExeption('xxxxx');
		}
		return $this->identity[$name];
	}

	public function getIdentities()
	{
		return $this->identity;
	}

}