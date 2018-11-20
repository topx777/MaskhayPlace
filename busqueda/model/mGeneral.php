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
    public function SitiosOrdenPuntuacion($ord='DESC')
    {
        $sql="SELECT AVG(calificacion.calificacion) as promedio, lugar.*
                FROM lugar
                INNER JOIN calificacion ON lugar.id_lugar=calificacion.lugar
                GROUP BY lugar.id_lugar
                ORDER BY promedio {$ord}";
        $this->db->query($sql);
        return $this->db->getRegistros();
    }
    public function SitiosOrdenRegistrados($ord='DESC')
    {
        $sql="SELECT AVG(calificacion.calificacion) as promedio, lugar.*
                FROM lugar
                INNER JOIN calificacion ON lugar.id_lugar=calificacion.lugar
                GROUP BY lugar.id_lugar
                ORDER BY lugar.id_lugar {$ord}";
        $this->db->query($sql);
        return $this->db->getRegistros();
    }
    public function buscarSitiosPorNombre($limit=null)
    {
        $sql="SELECT * 
                FROM lugar
                WHERE lugar.nombre_lugar LIKE '%a%'
                LIMIT 10";
        $this->db->query($sql);
        return $this->db->getRegistros();
    }
    public function Buscar($buscar, $categorias=[], $orden, $pts=[])
    {
        $sqlBuscar="";
        $sqlOrd="";
        $sqlPts;
        //coincidencias
        $sqlBuscar=" lugar.nombre_lugar LIKE '%{$buscar}%' ";
        //Categorias
        $sqlCat=[];
        foreach ($categorias as $categoria) {
            if($categoria=='hotel')
            {
                array_push($sqlCat, " lugar.categoria = 'Hotel' " );
            }
            if($categoria=='restaurante')
            {
                array_push($sqlCat, " lugar.categoria = 'Restaurante' ");                
            }
            if($categoria=='farmacia')
            {
                array_push($sqlCat, " lugar.categoria = 'Farmacia' ");                
            }
        }
        $sqlCategoria= join(' OR ', $sqlCat);
        $sqlCategoria=($sqlCategoria=='')?' ':" AND {$sqlCategoria}";

        //Orden
        switch ($orden) {
        case 'all':
        {
            $sqlOrd=" lugar.nombre_lugar ASC ";
        }
        break;
        case 'pop':
        {
            $sqlOrd=" promedio DESC ";
        }
        break;
        case 'ult':
        {
            $sqlOrd=" lugar.id_lugar DESC ";
        }
        break;
        }
        // Puntaje
        $sqlPts=[];
        foreach ($pts as $pt) {
            if($pt=='02')
            {
                array_push($sqlPts, ' promedio BETWEEN 0 AND 2 ');
            }
            if($pt=='34')
            {
                array_push($sqlPts, ' promedio BETWEEN 3 AND 4 ');
            }
            if($pt=='5')
            {
                array_push($sqlPts, ' promedio = 5 ');

            }
            if($pt=='all')
            {
                array_push($sqlPts, ' promedio BETWEEN 0 AND 5 ');
            }
        }
        $sqlPuntaje=join(' OR ', $sqlPts);
        $sqlPuntaje=($sqlPuntaje == '')?' ':"HAVING {$sqlPuntaje}";

        $sql="SELECT AVG(calificacion.calificacion) as promedio, COUNT(calificacion.calificacion) as numCalificaciones, lugar.*, calificacion.*
            FROM lugar
            INNER JOIN calificacion ON lugar.id_lugar=calificacion.lugar
            WHERE {$sqlBuscar}
                {$sqlCategoria}
            GROUP BY lugar.id_lugar
            {$sqlPuntaje}
            ORDER BY {$sqlOrd} ";
         //echo $sql.'<br><br>';
        $this->db->query($sql);
        return $this->db->getRegistros();
    }


}

?>