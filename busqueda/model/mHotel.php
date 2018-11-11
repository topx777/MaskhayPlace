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
    
    public function numHoteles()
    {
        $sql="SELECT COUNT(*) AS 'numHoteles' FROM `Hotel`";
        $this->db->query($sql);
        return $this->db->getRegistro()->numHoteles;
    }
}

?>