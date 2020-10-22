<?php 
session_start(); 
if ( !isset($_SESSION["ID"])  ){
    header("Location: FIN_CONEXION.php");
}
error_reporting(0);
require_once "include/conexion.php";
include "filtro.php";
$colcc='#CEECF5';
foreach ($_POST as $key => $value){
    $$key = $value;
}
foreach ($_GET as $key => $value){
    $$key = $value;
}
$colcc='#E0F8E6'; 
?>

<html lang="en">
<meta name="viewport" content="width=device-width, initial-scale=1">
<head>
	
    <link rel="shortcut icon" type="image/x-icon" href="images/favicon.ico">
	<!-- <link type="image/x-icon" href="favicon.ico" rel="icon" /> -->
	<link type="image/x-icon" href="favicon.ico" rel="shortcut icon" />
    <!-- <link rel="stylesheet" href="css/bootstrap/bootstrap.min.css"> -->
    <link rel="stylesheet" href="css/bootstrap/3.3.7/bootstrap.min.css">
    <link href="//netdna.bootstrapcdn.com/bootstrap/3.0.0/css/bootstrap-glyphicons.css" rel="stylesheet">
    <link rel="stylesheet" href="css/chosen/chosen.css">
    <link rel="stylesheet" href="css/estilos-daryza.css">
    <!-- fontawesome css -->
    <link rel="stylesheet" href="css/fontawesome/5.0.8/fa-solid.css">
    <link rel="stylesheet" href="css/fontawesome/5.0.8/fontawesome.css">
    <!-- Jquery Datatables Css --><!-- Tabla responsiva -->
    <link href="css/DataTables/dataTables.bootstrap.min.css" rel="stylesheet" />
    <link href="css/DataTables/responsive.dataTables.min.css" rel="stylesheet" />
    <script src="js/jquery/jquery.min.js"></script>
</head>
<body>
        
<?php
$operacion='';
$cmp='';
if( ! empty($_POST)){
    $valor=$_POST['valor'];
    $vcampo=$_POST['selectedCampo'];
    switch ($vcampo) {
                case 'numpedido':
                    $cmp="p.numpedido";
                    break;
                case 'planilla':
                    $cmp="p.aux1";
                    break;
                case 'placa':
                    $cmp="p.placa";
                    break;
                case 'cliente':
                    $cmp="p.cliente";
                    break;
                case 'documento':
                    $cmp="p.documento";
                    break;
                case 'estado':
                    $cmp="p.estado";
                    break;
    }

    if(!empty($vcampo) && !empty($valor)){
        $operacion=" and ".$cmp." like '%".$valor."%' ";    
    }
    $cmps="p.numpedido,p.idpedido,p.documento,left(p.cliente,30),p.volumen,left(p.distcliente,15),p.estado,p.fecentrega,p.horentrega,left(p.localpedido,25),p.placa,p.latitud,p.longitud,p.ventanaini,p.ventanafin,p.fechaprog,p.peso,p.aux1,p.orden,p.aux3,p.aux1,left(p.dircliente,30),left(p.refcliente,25),p.observacion,p.fot_foto,p.motivo,p.indice as Id,e.col_text, e.col_back";
    $tabl="trupal.reparto p inner join trupal.r_estados e on p.estado=e.estado";
    $cond="p.fechaprog=current_date";
    $query = "select ".$cmps." from ".$tabl." where ".$cond.$operacion." group by p.documento order by p.placa,p.orden;";
    // var_dump($query);exit();
    $result = mysql_query($query);

}else{
    $cmps="p.numpedido,p.idpedido,p.documento,left(p.cliente,30),p.volumen,left(p.distcliente,15),p.estado,p.fecentrega,p.horentrega,left(p.localpedido,25),p.placa,p.latitud,p.longitud,p.ventanaini,p.ventanafin,p.fechaprog,p.peso,p.aux1,p.orden,p.aux3,p.aux1,left(p.dircliente,30),left(p.refcliente,25),p.observacion,p.fot_foto,p.motivo,p.indice as Id,e.col_text, e.col_back";
    $tabl="trupal.reparto p inner join trupal.r_estados e on p.estado=e.estado";
    $cond="p.fechaprog=current_date";
    $query = "select ".$cmps." from ".$tabl." where ".$cond." group by p.documento order by p.placa,p.orden ; ";
    $result = mysql_query($query);
}
#echo $query;
$datos=array();
$j=0;
while($row = mysql_fetch_array($result)) {
		$datos[$j] = $row;
		$j++;
	} 

?>
<section class="content dashboard">
	<div class="page-body menu-body">

        <div class="panel panel-default borde">

        	<div class="panel-heading" style="background-color:white; margin:5px; padding:0px">
                    
                <div class="row">
                    <div class="col-md-2">
            			<td><img src="images/logo.png" width='130px' height="40px"></td>
                    </div>
                    <div class="col-md-10">
                        <table>
                            <tr>
                            <div class="header-nav animate-dropdown">
                                    <div class="container pedido-container">
                                        <div class="bs-example">
                                            <nav class="navbar navbar-inverse pedido-menu" role="navigation">
                                                <div class="container-fluid">

                                                    <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-animations" data-hover="dropdown" data-animations="fadeInDown fadeInRight fadeInUp fadeInLeft">
                                                        <ul class="nav navbar-nav">
                                                            <li style="padding: 12px;">
                                                              <div class="dropdown">
                                                                <a data-toggle="dropdown" style="color:black;">Pedidos
                                                                  <span class="caret"></span>
                                                                </a>
                                                                <ul class="dropdown-menu">
                                                                  <li><a href="p_actual.php">Actual</a></li>
                                                                  <li><a href="p_historico.php">Historicco</a></li>
                                                                </ul>
                                                              </div>
                                                            </li>
                                                            <li style="padding: 12px;">
                                                              <div class="dropdown">
                                                                <a data-toggle="dropdown" style="color:black;">Reparto
                                                                  <span class="caret"></span>
                                                                </a>
                                                                <ul class="dropdown-menu">
                                                                  <li><a href="r_actual.php">Actual</a></li>
                                                                  <li><a href="r_historico.php">Historicco</a></li>
                                                                </ul>
                                                              </div>
                                                            </li>
                                                            <li style="padding: 12px;">
                                                              <div class="dropdown">
                                                                <a data-toggle="dropdown" style="color:black;">Estadisticas
                                                                  <span class="caret"></span>
                                                                </a>
                                                                <ul class="dropdown-menu">
                                                                  <li><a href="estadistica_actual.php">Por placa</a></li>
                                                                  <li><a href="est_his.php">Por periodo</a></li>
                                                                </ul>
                                                              </div>
                                                            </li>
                                                            <li class="top"><a href="distrtack.com.pe" id="privacy" class="top_link" target=_self><span>Salida</span></a></li>            
                                                        </ul>
                                                    </div>
                                                </div>
                                            </nav>
                                        </div>
                                    </div>
                            </div>
                            </tr>
                        </table>
                    </div>
                </div>
						
            </div>
			<div class="panel-body">
                <div><h5>Reparto Actual</h5></div>
				<div class="panel-body p-b-25">

                    <form class="form-horizontal" role="form" action="" method="post" enctype="multipart/form-data">
                            <div class="form-group">
                               
                                <div class="col-sm-5 col-md-3">
                                        <label class="col-xs-4 control-label">Campo</label>
                                        <div class="col-xs-8">
                                            <select class="form-control chosen-select" id="selectedCampo" name='selectedCampo' data-placeholder="Seleccione un campo">
                                                <option value='<?=( !empty($vcampo) ? $vcampo : '')?>' select><?=( !empty($vcampo) ? $vcampo : '')?></option>
                                                <option value="numpedido">Num Pedido</option>
                                                <option value="planilla">Planilla</option>
                                                <option value="placa">Placa</option>
                                                <option value="cliente">Solicitante</option>
                                                <option value="documento">Documento</option>
                                                <option value="estado">Estado</option>
                                            </select>
                                        </div>
                                </div>
                                <div class="col-sm-5 col-md-2">
                                        <label class="col-xs-4 control-label">Valor</label>
                                        <div class="col-xs-8">
                                            <input type="text" class="form-control" id="valor" name="valor" placeholder="Ingrese el valor" value='<?=( !empty($valor) ? $valor : '')?>'>
                                        </div>
                                </div>
                                <div class="col-sm-2 col-md-1">
                                    <div class="col-sm-12">
                                        <div class="col-sm-offset-2 p-l-15">
                                            <button type="submit" class="btn btn-sm btn-success">Procesar</button>
                                        </div>
                                    </div>
                                </div>
                            </div>                    
                            
                            <table class="table table-striped table-hover js-exportable" id="example2" cellspacing="0" width="100%">
                                    <thead style="background-color:#131212f7; color:white;">
                                        <tr>
                                            <th width="10%"><center>Placa</center></th>
                                            <th width="12%"><center>Pedido</center></th>
                                            <th width="12%"><center>Documento</center></th>
                                            <th width="23%"><center>Cliente</center></th>
                                            <th width="23%"><center>Sucursal</center></th>
                                            <th width="10%"><center>Estado</center></th>
                                            <th width="2%"></th>
                                            <th width="2%"></th>
                                            <th width="2%"></th>
                                        </tr>
                                    </thead>
                                    <tbody class="tabla-pedidos">
                                        <?php foreach ($datos as $key => $value){ ?>
                                        <tr>
                                            <td class="center" align="center"><?=$value[10]?></td> 
                                            <td class="center" align="center"><?=$value[0]?></td> 
                                            <td class="center" align="center"><?=$value[2]?></td> 
                                            <td class="center"><?=$value[3]?></td> 
                                            <td class="center"><?=$value[22]?></td> 
                                            <td class="center" align="center" style="background-color:<?=$value['col_back']?>;color:<?=$value['col_text'];?> !important;"><?=$value[6]?></td> 
                                                <form action="" id="estadoAjax">
                                                <td class="text-center">
                                                    <?php 
                                                    if($value[6]  <> 'En Ruta'){
                                                        echo "<a style='color: #1a1919;' href='javascript:loadModalTiempos(".$value['Id'].");'><i class='fas fa-stopwatch'></i></a>";
                                                    } else {
                                                        echo "<a></a>";
                                                    }
                                                    ?>

                                                    
                                                </td>
                                                <td class="text-center">
                                                    <a  style="color: #1a1919;" href="javascript:loadModalDaryza(<?=$value['Id']?>);"><i class="fas fa-file-alt"></i></a>
                                                </td>
                                                <td class="text-center">
                                                    <?php 
                                                    if($value[11]  <> '' && $value[12] <> ''){
                                                        $Ubic = "show_map.php?var1=".$value[11]."&var2=".$value[12]."&var3=".$value[2]." / ".$value[0];
                                                        echo "<a style='color: #1a1919;' HREF=\""."javascript:void(window.open('".$Ubic."&dummy=.pdf','_blank', 'scrollbars=yes,toolbar=no,resizable=yes,menubar=no,location=no'))\""."><i class='fas fa-map-marker-alt'></i></a>";
                                                    } else {
                                                        echo "<a></a>";
                                                    }
                                                    ?>
                                                </td>
                                                <td class="text-center">
                                                    <?php
                                                    if($value[24] <> ''){
                                                        $Ubic = "show_galeria_app.php?var0=".$value[24];
                                                        echo "<a style='color: #1a1919;' HREF=\""."javascript:void(window.open('".$Ubic."&dummy=.pdf','_blank', 'scrollbars=yes,toolbar=no,resizable=yes,menubar=no,location=no'))\""."><i class='fas fa-camera'></i></a>";
                                                    } else {
                                                        echo "<a></a>";
                                                    }
                                                    ?>
                                                </td>
                                            </td>
                                                </form>
                                        </tr>
                                    <?php }?>                              
                                    </tbody>                        
                            </table>
                    </form>
					
				</div>
			</div>
		</div>
	</div>
</section>
<script language="JavaScript" type="text/javascript">
	// tigra_tables('Tabla_Detalle', 1, 0, '#ffffff', '#efefef', '#ffffcc', '#C8DCF2');
</script>
<p style="margin:40px;"><a href="repartodiario.php?local=X" <?php echo 'target="_blank"';?> title="Reparto diario"><b><img src="images/excell.jpg" width='60px' height="30px"></b></a> </p>
</form>
</body>
</html>
</section>

        </div>

        <!-- bootstrap js -->
        <!--<script src="js/bootstrap/bootstrap.min.js"></script>-->
        <script src="js/bootstrap/3.3.7/bootstrap.min.js"></script>
         
        <!-- fontawesome js -->
        <script src="css/fontawesome/5.0.8/fa-solid.js"></script>
        <script src="css/fontawesome/5.0.8/fontawesome.js"></script>
        <!-- chosen js -->
        <script src="js/chosen/chosen.jquery.min.js"></script>

        <!-- JQuery Datatables Js --><!-- Tabla responsiva -->
       <!--<script src="js/DataTables/jquery.dataTables.min.js"></script> -->
        <script src="js/actual/jquery.dataTables.min.js"></script>
        <script src="js/DataTables/dataTables.bootstrap.js"></script>

        <script src="js/actual/dashboard.js"></script>
        
    </body>
</html>


   <div class="modal fade" id="daryzaModal" tabindex="-1" role="dialog">
        <div class="modal-dialog" role="document">
            <div class="modal-content pedidos-modal-content">
                <div class="modal-header pedidos-modal-header">
                    <h4 class="modal-title" id="defaultModalLabel">Detalle</h4>
                </div>
                <div class="modal-body">
                </div>
            </div>
        </div>
    </div>

    <script type="text/javascript">
        function loadModalDaryza(daryza_id){
            console.log(daryza_id);
            $('.modal-body').load('daryzaModal.php?indice='+daryza_id,function(){
                $('#daryzaModal').modal({show:true});
            });
        }
    </script>

   <div class="modal fade" id="tiemposModal" tabindex="-1" role="dialog">
        <div class="modal-dialog" role="document">
            <div class="modal-content pedidos-modal-content">
                <div class="modal-header pedidos-modal-header">
                    <h4 class="modal-title" id="defaultModalLabel">Tiempos</h4>
                </div>
                <div class="modal-body">
                </div>
            </div>
        </div>
    </div>

    <script type="text/javascript">
        function loadModalTiempos(idd){
            console.log(idd);
            $('.modal-body').load('tiemposModal.php?idc='+idd,function(){
                $('#tiemposModal').modal({show:true});
            });
        }
    </script>