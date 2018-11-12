<?php
class Database
{
    private $host = 'localhost';
    private $user = 'root';
    private $password = 'root';
    private $name_db = 'maskhayplacedb';

    private $dbh;
    private $stmt;
    private $error;

    public function __construct() 
    {
        //configurar conexion
        $dsn = 'mysql:host=' . $this->host . ';dbname=' . $this->name_db;

        $options = array(
            PDO::ATTR_PERSISTENT => true ,
            PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION
         );
    
         //instancia pdo
        try{
            $this->dbh = new PDO($dsn, $this->user, $this->password, $options);
            $this->dbh->exec('set names utf8');
        }
        catch(PDOException $e){
            $this->error= $e->getMessage();
            echo $this->error;
        }
    }
//prepara consulta
    public function query($sql)
    {
        $this->stmt =$this->dbh->prepare($sql) ;
    }
//parametrisa consulta
    public function bind($param, $val, $type = null)
    {
        if (is_null($type)) 
        {
            switch (true) {
                case is_int($val):
                    $type=PDO::PARAM_INT;
                break;
                case is_bool($val):
                    $type=PDO::PARAM_BOOL;
                break;
                case is_null($val):
                    $type=PDO::PARAM_NULL;
                break;
                
                default:
                    $type = PDO::PARAM_STR;
                break;
            }
        }
        $this->stmt->bindValue($param, $val, $type);
    }
//ejecuta consulta
    public function execute()
    {
        try
        {
            return $this->stmt->execute();
        }
        catch(PDOException $e)
        {
            echo $e;
        }
    }
//Obtener registros
    public function getRegistros()
    {
        $this->execute();
        return $this->stmt->fetchAll(PDO::FETCH_OBJ);
    }
//Obtener Registro
    public function getRegistro()
    {
        $this->execute();
        return $this->stmt->fetch(PDO::FETCH_OBJ);
    }
    //cantidad de filas
    public function numRows()
    {
        return $this->stmt->rowCount();

    }
    //Ultimo id insertado
    public function lastId()
    {
        return $this->dbh->lastInsertId();
    }
    
}

?>
