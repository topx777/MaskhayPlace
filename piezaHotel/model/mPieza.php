<?php 
class mPieza
{
    public function __construct() {
        $this->db=new Database;
    }
    public function registrar($datos=[])
    {
        $sql="INSERT INTO `pieza`(`nombre_pieza`, `descripcion_pieza`, `precio_noche`, `sanitario_privado`, `frigobar`, `hotel`, `imagen_pieza`) 
                VALUES ('{$datos['nombre_pieza']}', 
                        '{$datos['descripcion_pieza']}',
                        '{$datos['precio_noche']}',
                        '{$datos['sanitario_privado']}',
                        '{$datos['frigobar']}',
                        '{$datos['hotel']}', 
                        '{$datos['imagen_pieza']}' )";

        $this->db->query($sql);
        return $this->db->execute();
    }
    public function editar($id_pieza,$datos=[])
    {
        $sqldatos=[];
        foreach ($datos as $atributo => $value) {
            array_push($sqldatos, "`{$atributo}`= '{$value}'");
        }
        $sqldatos=join(' , ', $sqldatos);
        $sql="UPDATE `pieza` 
                SET {$sqldatos}
                WHERE id_pieza={$id_pieza}";
        $this->db->query($sql);
        return $this->db->execute();
    }
    public function eliminar($id_pieza)
    {
        $sql="DELETE FROM `pieza` WHERE `id_pieza`= '{$id_pieza}'";
        $this->db->query($sql);
        return $this->db->execute();
    }

}

?>