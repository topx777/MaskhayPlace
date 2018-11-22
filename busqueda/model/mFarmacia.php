<?php 
class mFarmacia 
{
    public function __construct() {
        $this->db=new Database;
    }
    public function getFarmacias($limit=null)
    {
        if ($limit==null) {
            $sql="SELECT * FROM `Farmacia` ORDER BY `id_farmacia` DESC";
        }
        if($limit!=null)
        {
            $sql="SELECT * FROM `Farmacia` ORDER BY `id_farmacia` DESC LIMIT {$limit}";
        }
        $this->db->query($sql);
        return $this->db->getRegistros();
    }

    public function buscarFarmaciasNombre($limit=null, $claveBusqueda)
    {
        $sql="SELECT * FROM Farmacia f 
                INNER JOIN lugar l ON f.lugar=l.id_lugar 
                WHERE l.nombre_lugar LIKE '%{$claveBusqueda}%'";
        if ($limit!=null) {
            $sql.=" LIMIT {$limit}";
        }
        $this->db->query($sql);
        return $this->db->getRegistros();
    }

    public function buscarFarmaciasPuntuacion($limit=null, $puntaje)
    {
        $sql="SELECT AVG(C.calificacion) AS promedio, F.*, L.*,C.*
                FROM farmacia F 
                INNER JOIN lugar L ON F.lugar=L.id_lugar
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
        $sql="SELECT IFNULL(AVG(C.calificacion),0) AS promedio, F.*, L.*,C.*
                FROM farmacia F 
                INNER JOIN lugar L ON F.lugar=L.id_lugar
                LEFT JOIN calificacion C ON C.lugar=L.id_lugar
                WHERE L.activo=1
                GROUP BY L.id_lugar
                ORDER BY promedio DESC";
        if($limit!=null)
        {
            $sql.=" LIMIT {$limit}";
        }
        $this->db->query($sql);
        return $this->db->getRegistros();
    }
    public function numFarmacias()
    {
        $sql="SELECT COUNT(*) AS 'numFarmacias' FROM `Farmacia`
        INNER JOIN lugar ON lugar.id_lugar=farmacia.lugar
        WHERE lugar.activo=1";
        $this->db->query($sql);
        return $this->db->getRegistro()->numFarmacias;

    }
}

?>