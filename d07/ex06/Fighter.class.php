<?php
abstract class Fighter
{
	abstract function fight($kill);

	public $t_soldier;

	public function __construct( $type )
	{
		$this->t_soldier = $type;
	}

	public function getType()
	{
		return ($this->t_soldier);
	}

	public function __clone()
	{

	}

}

?>