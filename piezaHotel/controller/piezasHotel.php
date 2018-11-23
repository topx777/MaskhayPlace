<?php
spl_autoload_register(function($nombreClase)
{
    require_once '../model/' . $nombreClase . '.php';
});
$mPieza=new mPieza;
$id_Hotel=(isset($_POST['id_hotel']))?$_POST['id_hotel']:'';?>
<?php if ($id_Hotel!=''): ?>
<?php  $piezas=$mPieza->getPiezasHotel($id_Hotel); ?>
    <?php foreach ($piezas as $pieza):?>
            <tr class="pricing-list-item">
                <td>
                    <div class="row">
            
                        <div class="col-md-2">
                            <div class="form-group">
                                <input type="text" class="form-control" placeholder="Nombre" required="" value="<?= $pieza->nombre_pieza;?>">
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <input type="text" class="form-control" placeholder="Descripcion" required="" value="<?= $pieza->descripcion_pieza; ?>">
                            </div>
                        </div>
            
                        <div class="col-md-2">
                            <div class="form-group">
                                <input type="number" class="form-control" placeholder="Precio" min="0" required="" value="<?= $pieza->precio_noche;?>">
                            </div>
                        </div>
            
                        <div class="col-md-2">
                            <div class="form-group">
                                <table class="sw">
                                    <tr>
                                        <td>
                                            <label id="lb">Sanitario</label>
                                        </td>
                                        <td class="btnswich">
                                            <label class="switch">
                                                <input type="checkbox" <?php echo ($pieza->sanitario_privado==1)?'checked':'';?>>
                                                <div class="slider round"></div>
                                            </label>
                                        </td>
                                    </tr>
                                </table>
                            </div>
                        </div>
            
                        <div class="col-md-2">
                            <div class="form-group">
                                <table class="sw">
                                    <tr>
                                        <td>
                                            <label id="lb">Frigobar</label>
                                        </td>
                                        <td class="btnswich">
                                            <label class="switch">
                                                <input type="checkbox" <?php echo ($pieza->frigobar==1)?'checked':'';?>>
                                                <div class="slider round"></div>
                                            </label>
                                        </td>
                                    </tr>
                                </table>
                            </div>
                        </div>
            
                        <div class="col-md-4">
                            <div class="form-group">
                                <img src="<?= $sitio->imagen_pieza;?>" alt="">
                                <center><label>Imagen de la Habitacion</label></center>
                            </div>
                        </div>
            
                    </div>
                </td>
            </tr>
    <?php endforeach;?>
<?php endif;?>