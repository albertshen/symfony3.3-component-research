<?php

interface Person
{
	public function show();
}

class Student implements Person
{
	private $name;

	public function __construct($name)
	{
		$this->name = $name;
	}

	public function show()
	{
		echo $this->name.'穿着校服';
	}
}

abstract class Decorator implements Person
{
	protected $person;

	public function __construct(Person $person)
	{
		$this->person = $person;
	}
}

class RedShoe extends Decorator
{
	public function show()
	{
		echo $this->person->show() . '，红色鞋子';
	}
}

class BlackHat extends Decorator
{
	public function show()
	{
		echo $this->person->show() . '，黑色帽子';
	}
}

$student = new Student('Albert');

$redshoe = new RedShoe($student);

$blackhat = new BlackHat($redshoe);

$blackhat->show();
