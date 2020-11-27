<?php 
require_once("../clases/class.Sesion.php");
//creamos nuestra sesion.
$se = new Sesion();


if(!isset($_SESSION['se_SAS']))
{
	header("Location: ../login.php");
	exit;
}



require_once('../clases/class.Mensajes.php');
require_once('../clases/class.Sms.php');


$sms = new SMS();

//Recibo parametros
$mensaje = trim($_POST['mensaje']);


$itemsEnCesta = $_SESSION['Numeros'];
$cantidad = count($itemsEnCesta); // obtenemos la longitud del array de sesion
					  		
		
if(isset($itemsEnCesta) && $cantidad>0) // validamos que la session de array exista y que contenga un producto
{
	foreach(array_reverse($itemsEnCesta,true) as $k => $v)
	{
		$sms->EnviarSMS("52".$v, $mensaje, false);
	}
	//eliminamos la sesion del carrito
    $se->eliminarSesion('Numeros');
	echo 1;
}




?>