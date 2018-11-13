<?php
class mHotel
{
    public function __construct() {
        $this->db=new Database;
    }
    public function getHoteles($limit=null)
    {
        if ($limit==null) {
            $sql="SELECT * FROM `Hotel` ORDER BY `id_Hotel` DESC";
        }
        if($limit!=null)
        {
            $sql="SELECT * FROM `Hotel` ORDER BY `id_Hotel` DESC LIMIT {$limit}";
        }
        $this->db->query($sql);
        return $this->db->getRegistros();
    }

    public function buscarHotelesNombre($limit=null, $claveBusqueda)
    {
        $sql="SELECT * FROM hotel h 
                INNER JOIN lugar l ON h.lugar=l.id_lugar
                WHERE l.nombre_lugar LIKE '%{$claveBusqueda}%'";
        if ($limit!=null) {
            $sql.="LIMIT {$limit}";
        }
        $this->db->query($sql);
        return $this->db->getRegistros();
    }
    public function buscarHotelesPuntuacion($limit=null, $puntaje)
    {
        $sql="SELECT AVG(C.calificacion) AS promedio, H.*, L.*,C.*
                FROM Hotel H
                INNER JOIN lugar L ON H.lugar=L.id_lugar
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
        $sql="SELECT AVG(C.calificacion) AS promedio, H.*, L.*,C.*
                FROM hotel H 
                INNER JOIN lugar L ON H.lugar=L.id_lugar
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
    public function numHoteles()
    {
        $sql="SELECT COUNT(*) AS 'numHoteles' FROM `Hotel`";
        $this->db->query($sql);
        return $this->db->getRegistro()->numHoteles;
    }
}
?>