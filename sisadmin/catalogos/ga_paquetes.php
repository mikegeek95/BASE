<?php
require_once("../clases/class.Sesion.php");
//creamos nuestra sesion.
$se = new Sesion();


if(!isset($_SESSION['se_SAS']))
{
	header("Location: ../login.php");
	exit;
}

require_once("../clases/conexcion.php");
require_once ("../clases/class.Paquetes.php");
require_once('../clases/class.MovimientoBitacora.php');

try{

$db = new MySQL ();
$paq = new Paquetes();
$md = new MovimientoBitacora();

$paq->db = $db ;
$md->db = $db;

$db->begin();


$paq->nombre = $_POST['nombre'];

$paq->descripcion = $_POST['desc'];

$paq->cantidad_minima = $_POST['minima'];

$paq->cantidad_maxima = $_POST['maxima'];

$paq->descuento = $_POST['descuento'];

$paq->estatus = $_POST['estatus'];



$paq->agregarPaquete();
$md->guardarMovimiento(utf8_decode('Paquetes'),'Paquetes',utf8_decode('Nuevo Paquete  creado con el ID :'.$paq->idpaquete_descuentos));

$db->commit();
echo 1 ;



}//fin del try

catch (Exception $e)

{
    $db->rollback();
	$v = explode ('|',$e);

		// echo $v[1];

	     $n = explode ("'",$v[1]);

		 $n[0];

	$result = $db->m_error($n[0]);

	echo $result ;

	

}



?>