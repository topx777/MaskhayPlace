<?php
class mRestaurante
{
    public function __construct() {
        $this->db=new Database;
    }
    public function getRestaurantes($limit=null)
    {
        if ($limit==null) {
            $sql="SELECT * FROM `Restaurante` ORDER BY `id_restaurante` DESC";
        }
        if($limit!=null)
        {
            $sql="SELECT * FROM `Restaurante` ORDER BY `id_restaurante` DESC LIMIT {$limit} ";
        }
        $this->db->query($sql);
        return $this->db->getRegistros();
    }
    public function buscarRestaurantes($limit=null, $claveBusqueda)
    {
        $sql="SELECT * FROM `Restaurante` WHERE ";
        if ($limit==null) {

        }
        if ($limit!=null) {

        }
    }
    public function numRestaurantes()
    {
        $sql="SELECT COUNT(*) AS 'numRestaurantes' FROM `Restaurante`";
        $this->db->query($sql);
        return $this->db->getRegistro()->numRestaurantes;
    }
}

?>