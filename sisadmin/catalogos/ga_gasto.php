<?php 
require_once("../clases/class.Sesion.php");
//creamos nuestra sesion.
$se = new Sesion();


if(!isset($_SESSION['se_SAS']))
{
	header("Location: ../login.php");
	exit;
}

require_once('../clases/conexcion.php');
require_once('../clases/class.MovimientoBitacora.php');
require_once("../clases/class.Gastos.php");

try
{
	$md = new MovimientoBitacora();
	$db = new MySQL();
	$ga = new Gastos();
	$ga->db=$db;
	$md->db = $db;
	
	$db->begin();
	
	
		
	$ga->categoria = utf8_decode($_POST['v_gasto']);
	$ga->descripcion = utf8_decode($_POST['v_descripcion']);
	$ga->tipo = $_POST['v_tipo'];
	
	
		
	$ga->GuardarNewGasto(); //guardado de plaza en la base de datos
		
	$md->guardarMovimiento(utf8_decode('Gastos'),'Gastos',utf8_decode('se agrego una nuevo concepto de gasto con el id '.$ga->ultimoIDGasto));
	$db->commit();
		
	echo 1;
	
}
catch(Exception $e)
{
	
    $db->rollback();
	 $v = explode ('|',$e);

		// echo $v[1];

	     $n = explode ("'",$v[1]);

		 $n[0];

		 echo $db->m_error($n[0]);	
}
?>