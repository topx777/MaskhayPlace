<?php 
class mGeneral
{
    public function __construct() {
        $this->db=new Database;
    }
    public function numeroSitiosPorPuntaje($pts)
    {
        $sql="SELECT AVG(C.calificacion) As promedio, L.nombre_lugar
        FROM lugar L
        INNER JOIN calificacion C ON C.lugar=L.id_lugar
        GROUP BY L.id_lugar 
        HAVING promedio = {$pts}";
        $this->db->query($sql);
        $this->db->execute();
        return $this->db->numRows();
    }
}

?>