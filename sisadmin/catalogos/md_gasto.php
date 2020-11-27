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
	$md->db = $db;
	
	$db->begin();
	
	$ga->db=$db;
		
	$ga->idgastos_categoria = $_POST['id'];
	$ga->categoria = utf8_decode($_POST['v_gasto']);
	$ga->descripcion = utf8_decode($_POST['v_descripcion']);
	$ga->tipo = $_POST['v_tipo'];
	$ga->estatus = $_POST['v_estatus'];
	
	
		
	$ga->ModificarGasto(); //guardado de plaza en la base de datos
		
	$md->guardarMovimiento(utf8_decode('Gastos'),'Gastos',utf8_decode('se Modifico una nuevo concepto de gasto con el id '.$ga->cod_gasto));
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

	$result = $db->m_error($n[0]);

	echo $result ;
}
?>