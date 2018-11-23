<?php
spl_autoload_register(function($nombreClase)
{
    require_once '../model/' . $nombreClase . '.php';
});
$db=new Database;
$id_lugar=(isset($_POST['id_lugar']))?$_POST['id_lugar']:'1';
$sql="SELECT * 
FROM calificacion 
INNER JOIN usuarioregistrado ON calificacion.usuario=usuarioregistrado.id_usuarioregistrado
INNER JOIN lugar ON lugar.id_lugar=calificacion.lugar
WHERE calificacion.lugar='{$id_lugar}'";
$db->query($sql);
$datos=$db->getRegistros();
?>
<?php foreach ($datos as $dato) :?>
<li>
						<span><?php echo $dato->fecha;?></span>
						<span class="rating"><?php echo estrellas($dato->calificacion);?></span>
						<figure><img src="<?php echo $dato->logo;?>" alt=""></figure>
						<h4><?php echo $dato->nombre_lugar;?> <small>por <?php echo " {$dato->nombre} {$dato->apellidos}";?></small></h4>
						
						<p><?php echo $dato->comentario;?></p>
					</li>
<?php endforeach;?>

<?php
function estrellas($num)
{
    $estrellas="";
    for ($i=0; $i <$num ; $i++) { 
        $estrellas.='<i class="fa fa-fw fa-star yellow"></i>';
    }
    return $estrellas;
}
?>