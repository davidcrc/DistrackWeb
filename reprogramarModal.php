<?php
require_once "include/conexion.php";
$sql="select b.numpedido,b.idpedido,b.documento,left(b.cliente,30) as cliente,b.volumen,left(b.distcliente,15),b.estado,b.fecentrega,b.horentrega,
left(b.localpedido,25) as localpedido,b.placa,b.latitud,b.longitud,b.ventanaini,b.ventanafin,b.fechaprog,b.peso,b.aux1,b.orden,b.aux3,b.aux1,
left(b.dircliente,30) as direccion,left(b.refcliente,25) as refcliente,b.observacion,b.fot_foto,b.motivo,b.indice as Id from intralot.pedidos b
where b.indice='".$_GET['indice']."' order by b.placa,b.orden;";
$indice_ = $_GET['indice'];
$result = mysql_query($sql);
$datos=array();
$j=0;
$placa_ = "";
//$fechaNew = $_POST["nuevaFecha"];




while($row = mysql_fetch_array($result)) {
		$datos[$j] = $row;
		$j++;
	} 

$sql="select p.placa, p.documento, e.estado, e.motivo, e.latitud, e.longitud, e.fecha, e.hora from intralot.pedidos p inner join appdistrack.reg_estados e on p.documento = e.documento where  p.indice='".$_GET['indice']."' order by e.hora ;";
$result = mysql_query($sql);
$tiempos=array();
$j=0;
while($row = mysql_fetch_array($result)) {
        $tiempos[$j] = $row;
        $j++;
    }     

//<button type="button" id="btn" class="btn btn-info" data-toggle="modal" data-target="#myModal" >Enivar Data</button>
?>
    <div class="page-body">
        <div class="panel panel-default">
                <div class="panel-body">
                    <table class="table table-striped table-hover js-exportable dataTable" cellspacing="0" width="100%">
                            <tbody>
                                <?php foreach ($datos as $key => $value):
                                    $placa_ = $value['placa']; ?>
                                
                                    <tr><td>Ord</td><td><?=$value['orden']?></td><td>Placa</td><td><?=$value['placa']?></td></tr>
                                    <tr><td>Pedido</td><td><?=$value['numpedido']?></td><td>Placa</td><td><?=$value['placa']?></td></tr>
                                    <tr><td>Estado</td><td><?=$value['estado']?></td><td>Fecha</td><td><?=$value['fechaprog']?></td></tr>
                                    
                            	<?php endforeach;?>
                            </tbody>                      
                    </table>
                   
                    <form action="" name="valorT">
                    
                        <input type="submit" name="valor" value="test" >
                    </form>


                </div>
                <div class="panel-footer">
                	<button type="button" class="btn btn-danger" data-dismiss="modal"><i class="fa fa-close"></i> Cerrar </button>
                </div>
        </div>
    </div>

    