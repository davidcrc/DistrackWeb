<?php
session_start();
foreach ($_POST as $key => $value){
    $$key = $value;
}
foreach ($_GET as $key => $value){
    $$key = $value;
} 

header("Content-type: application/vnd.ms-excel"); //para sugerir abrir con excel
header("Content-Disposition: attachment; filename=repartohistorico.xls");

require "include/conexion.php";
$tabla="<table width=800 border=1 align=center cellpadding=1 cellspacing=1>";
$tabla.="<tr><td colspan=13 align=center><font color=Navy><u><b>Ultimos 500 despachos hist�ricos</b></u></font></td></tr>";
$tabla.="<tr>";
$tabla.="<td bgcolor=blue><b><font color=white>No</b></td>";
$tabla.="<td bgcolor=blue><b><font color=white>Pedido</b></td>";
$tabla.="<td bgcolor=blue><b><font color=white>ID</b></td>";
$tabla.="<td bgcolor=blue><b><font color=white>N� Gu�a</b></td>";
$tabla.="<td bgcolor=blue><b><font color=white>Cliente</b></td>";
$tabla.="<td bgcolor=blue><b><font color=white>Volumen</b></td>";
$tabla.="<td bgcolor=blue><b><font color=white>Distrito</b></td>";
$tabla.="<td bgcolor=blue><b><font color=white>Estado</b></td>";
$tabla.="<td bgcolor=blue><b><font color=white>Fecha</b></td>";
$tabla.="<td bgcolor=blue><b><font color=white>Bloque de atenci�n</b></td>";
$tabla.="<td bgcolor=blue><b><font color=white>H.Entrega</b></td>";
$tabla.="<td bgcolor=blue><b><font color=white>Tienda</b></td>";
$tabla.="<td bgcolor=blue><b><font color=white>Placa</b></td>";
$tabla.="</tr>";
$and_historico="";
if ($local =='historico'){
	$sesion=$_SESSION['ID'];
	$and_pedido="";
	if ( !empty($vpedido) ){
		$and_pedido=" and pedido like '%$vpedido%' ";
	}
	$and_guia="";
	if ( !empty($vguia) ){
		$and_guia=" and guia like '%$vguia%' ";
	}
	$and_placa="";
	if ( !empty($vplaca) ){
		$and_placa=" and unidad like '%$vplaca%' ";
	}
	$and_fecha="";
	if ( !empty($vfecha) ){
		$and_fecha=" and b.fentrega= date_format(str_to_date('$vfecha','%d-%m-%Y'),'%d/%m/%Y') ";	
	}
	$and_estado="";
	if ( !empty($vestado) ){
		$and_estado=" and b.estado= '$vestado' ";	
	}
	$and_distrito="";
	if ( !empty($vdistrito) ){
		$and_distrito=" and b.distrito= '$vdistrito' ";	
	}
	$and_sucursal="";
	if ( !empty($vsucursal) ){
		$and_sucursal=" and b.sucursal= '$vsucursal' ";	
	}
}

$and_saga="";
if ($local =='saga'){
	$and_saga=" and b.producto='Saga' ";
}
$and_ripley="";
if ($local =='ripley'){
	$and_ripley=" and b.producto='Ripley' ";
}
$and_rizzoli="";
if ($local =='rizzoli'){
	$and_rizzoli=" and b.producto='Rizzoli' ";
}
$and_varios="";
if ($local =='varios'){
	$and_varios=" and b.producto not in('Saga','Ripley','Rizzoli') ";
}
$query="select b.pedido,b.id,b.guia,left(b.cliente,40),b.volumen,b.distrito,b.estado,b.fentrega,concat(vhinicio,' - ',vhfinal),b.vatfinal,b.sucursal,b.unidad from paraiso.historia_maestropedidos b,gpslog.livedata l where b.unidad=l.vehicleReg and b.unidad in(select l.VehicleReg from gpslog.netusers n,gpslog.system_users s,gpslog.livedata l where l.VehicleID=n.UIN and n.NetUserUIN=s.ID and s.ID=".$_SESSION['ID'].") ".$and_saga.$and_ripley.$and_rizzoli.$and_varios." order by b.index1 desc limit 500";
$result=mysql_query($query) or die(mysql_error());  //die muestra el error y sale
$NO=0;
while($row = mysql_fetch_array($result)) {  
	$NO++;
	$pedido		= $row[0];
	$id			= $row[1];
	$nroguia	= $row[2];
	$cliente	= ucwords($row[3]);
	$volumen	= $row[4];
	$distrito	= ucwords($row[5]);
	$estado		= $row[6];
	$fecha		= $row[7];
	$bloqueat	= $row[8];
	$hentrega	= $row[9];
	$tienda		= ucwords($row[10]);
	$placa		= $row[11];
	$tabla.="<tr>";
	$tabla.="<td>".$NO."</td>";
	$tabla.="<td>".$pedido."</td>";
	$tabla.="<td>".$id."</td><td>".$nroguia."</td>";
	$tabla.="<td>".$cliente."</td>";
	$tabla.="<td>".$volumen."</td>";
	$tabla.="<td>".$distrito."</td>";
	$tabla.="<td>".$estado."</td>";
	$tabla.="<td>".$fecha."</td>";
	$tabla.="<td>".$bloqueat."</td>";
	$tabla.="<td>".$hentrega."</td>";
	$tabla.="<td>".$tienda."</td>";
	$tabla.="<td>".$placa."</td>";
	$tabla.="</tr>";
}
$tabla.="</table>";
echo $tabla;
?>