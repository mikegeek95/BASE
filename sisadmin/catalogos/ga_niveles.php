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
require_once("../clases/class.Categoria_Descuento.php");
require_once('../clases/class.MovimientoBitacora.php');

try

{

	$db= new MySQL();
	$cd = new categoria_descuento();
	$md = new MovimientoBitacora();
	
	$cd->db = $db;
	$md->db = $db;

	$db->begin();

	

	//enviamos datos a las variables de la tablas
	$categoria = trim($_POST['nivel']);
	$estatus = $_POST['estatus'];	


	$cd->nombre = $categoria;
	$cd->estatus = $estatus;
		
	//guardando
	$cd->guardarNivel();
	$md->guardarMovimiento(utf8_decode('Nivel'),'niveles',utf8_decode('Nueva Nivel creado con el ID :'.$cd->ultimoidnivel));

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