<?php
class Conexion extends MySqli
{
    public function __construct() {
		parent::__construct('localhost','root','','maskhayplacedb');
		$this->connect_errno ? die('ERROR: Conexion a la base de datos fallida') : null; 
	}

	public function charset() {
		return $this->set_charset("utf8");
	}

	public function ultimaId() {
		return $this->insert_id;
	}

	public function rows($x) {
		return mysqli_num_rows($x);
	}

	public function afectado($x) {
		return mysqli_affected_rows($x);
	}

	public function recorrer($x) {
		return mysqli_fetch_array($x);
	}

	public function fetchAll($x) {
		return mysqli_fetch_all($x,MYSQLI_ASSOC);
	}

	public function liberar($x) {
		return mysqli_free_result($x);
	}

	public function preparada() {
		return mysqli_stmt_init();
	}
}
?>