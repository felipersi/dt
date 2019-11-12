<?php 
include_once('../models/classDB.php');

class mon extends db {

	public function monitora (){

		$busca = $conecta->select_status_migrando($status);


	}
}

