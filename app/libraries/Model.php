<?php

class Model
{
	protected $conn;

	public function __construct()
	{
		$this->conn = new Connection;
	}
}