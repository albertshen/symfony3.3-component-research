<?php

class A
{
	public static function aStatic()
	{
		echo __CLASS__;
	}

	public static function bStatic()
	{
		self::aStatic();
	}

	public static function bStaticBind()
	{
		static::aStatic();
	}

	public function aDynamic()
	{
		echo __CLASS__;
	}

	public function cDynamicStatic()
	{
		self::aStatic();
	}

	public function cDynamicStaticBind()
	{
		static::aStatic();
	}

	public function dDynamic()
	{
		$this->aDynamic();
	}


}

class B extends A 
{
    public static function aStatic() {
        echo __CLASS__;
    }

}

B::aStatic();
B::bStatic();
B::bStaticBind();

$dynamic = new B;
$dynamic->cDynamicStatic();
$dynamic->cDynamicStaticBind();

$dynamic->aDynamic();
$dynamic->dDynamic();






