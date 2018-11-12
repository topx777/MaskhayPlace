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
    public function numFarmacias()
    {
        $sql="SELECT COUNT(*) AS 'numFarmacias' FROM `Farmacia`";
        $this->db->query($sql);
        return $this->db->getRegistro()->numFarmacias;
    }
}

?>