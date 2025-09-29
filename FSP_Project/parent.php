<?php
	require_once("dataCon.php");

	class ortu {
		protected $con;

		public function __construct() {
			$this->con = new mysqli(SERVER_NAME, USER_NAME, PASSWORD, DB_NAME);
		}
	}

?>