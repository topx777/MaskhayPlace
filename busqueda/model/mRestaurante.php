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

    public function buscarRestaurantesNombre($limit=null, $claveBusqueda)
    {
        $sql="SELECT * FROM Restaurante r 
                INNER JOIN lugar l ON r.lugar=l.id_lugar 
                WHERE l.nombre_lugar LIKE '%{$claveBusqueda}%'";
        if ($limit!=null) {
            $sql.="LIMIT {$limit}";
        }
        $this->db->query($sql);
        return $this->db->getRegistros();
    }
    public function buscarRestaurantesPuntuacion($limit=null, $puntaje)
    {
        $sql="SELECT AVG(C.calificacion) AS promedio, R.*, L.*,C.*
                FROM Restaurante R 
                INNER JOIN lugar L ON R.lugar=L.id_lugar
                INNER JOIN calificacion C ON C.lugar=L.id_lugar
                GROUP BY L.id_lugar
                HAVING promedio={$puntaje}";
        if($limit!=null)
        {
            $sql.="LIMIT {$limit}";
        }
        $this->db->query($sql);
        return $this->db->getRegistros();
    }
    public function masPuntuados($limit=null)
    {
        $sql="SELECT AVG(C.calificacion) AS promedio, R.*, L.*,C.*
                FROM Restaurante R 
                INNER JOIN lugar L ON R.lugar=L.id_lugar
                INNER JOIN calificacion C ON C.lugar=L.id_lugar
                GROUP BY L.id_lugar
                ORDER BY promedio DESC";
        if($limit!=null)
        {
            $sql.=" LIMIT {$limit}";
        }
        $this->db->query($sql);
        return $this->db->getRegistros();
    }
    public function numRestaurantes()
    {
        $sql="SELECT COUNT(*) AS 'numRestaurantes' FROM `Restaurante`";
        $this->db->query($sql);
        return $this->db->getRegistro()->numRestaurantes;
    }
}

?>