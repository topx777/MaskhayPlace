<?php 
class mGeneral
{
    public function __construct() {
        $this->db=new Database;
    }
    public function numeroSitiosPorPuntaje($pts1, $pts2)
    {
        $sql="SELECT AVG(calificacion.calificacion) AS promedio, lugar.nombre_lugar
                FROM lugar 
                INNER JOIN calificacion  ON calificacion.lugar=lugar.id_lugar
                WHERE lugar.activo=1
                GROUP BY lugar.id_lugar 
                HAVING promedio BETWEEN {$pts1} AND {$pts2}";
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
    public function Buscar($buscar, $categorias=[], $orden, $pts=[], $coordenada=[], $distancia)
    {
        $sqlBuscar="";
        $sqlOrd="";
        $sqlPts;
        //coincidencias
        $sqlBuscar= ($buscar!='')?" AND lugar.nombre_lugar LIKE '%{$buscar}%' ":' ';
        //Categorias
        $sqlCat=[];
        foreach ($categorias as $categoria) {
            if($categoria=='hotel')
            {
                array_push($sqlCat, " lugar.categoria = 'Hotel' AND lugar.activo='1' " );
            }
            if($categoria=='restaurante')
            {
                array_push($sqlCat, " lugar.categoria = 'Restaurante' AND lugar.activo='1' ");                
            }
            if($categoria=='farmacia')
            {
                array_push($sqlCat, " lugar.categoria = 'Farmacia' AND lugar.activo='1' ");                
            }
        }
        $sqlCategoria= join(' OR ', $sqlCat);
        $sqlCategoria=($sqlCategoria=='')?' ':" AND {$sqlCategoria}";
        //Distancia
        $sqlLimitCoord=" ";
        $const=$distancia*0.10;
        if (isset($coordenada[0]) && isset($coordenada[1]) && $const>0) {
            $limLat=[];
            $limLng=[];
            $limLng['max']=$coordenada[1]+$const;
            $limLng['min']=$coordenada[1]-$const;
            
            $limLat['max']=$coordenada[0]+$const;
            $limLat['min']=$coordenada[0]-$const;
            
            $sqlLimitCoord=" AND lugar.latitud_gps >= {$limLat['max']} OR lugar.latitud_gps <= {$limLat['min']}
                            AND lugar.longitud_gps >= {$limLng['max']} OR lugar.longitud_gps <= {$limLng['min']}";
        }

        
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

        $sql="SELECT IFNULL(AVG(calificacion.calificacion),0) as promedio, COUNT(calificacion.calificacion) as numCalificaciones, lugar.*, calificacion.*
            FROM lugar
            LEFT JOIN calificacion ON lugar.id_lugar=calificacion.lugar
            WHERE lugar.activo = 1 
                {$sqlBuscar}
                {$sqlCategoria}
                {$sqlLimitCoord}
            GROUP BY lugar.id_lugar
            {$sqlPuntaje}
            ORDER BY {$sqlOrd} ";
        //echo $sql.'<br><br>';
        $this->db->query($sql);
        return $this->db->getRegistros();
    }


}

?>