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
require_once("../clases/class.Paqueterias.php");
require_once('../clases/class.MovimientoBitacora.php');

try

{

	$db = new MySQL();
	$pa = new Paqueterias();
	$md = new MovimientoBitacora();
	
	$pa->db = $db;
	$md->db = $db;
	
	$db->begin();

	
	//enviamos datos a las variables de la tablas	
	$pa->nombre = utf8_decode($_POST['nombre']);
	$pa->direccion = utf8_decode($_POST['direccion']);
	$pa->tel = $_POST['telefono'];
	$pa->email = utf8_decode($_POST['email']);
	$pa->urlrastreo = utf8_decode($_POST['urlrastreo']);
	$pa->estatus = $_POST['estatus'];
	$pa->idpaqueterias = $_POST['idpaqueterias'];
	
	
	if($pa->idpaqueterias == 0){
		//guardando
		$pa->guardar_paqueteria();
		$md->guardarMovimiento(utf8_decode('paqueterias'),'paqueterias',utf8_decode('Nueva paqueteria creado con el ID :'.$pa->idpaqueterias));	
	}else{
		$pa->modificar_paqueteria();
		$md->guardarMovimiento(utf8_decode('paqueterias'),'paqueterias',utf8_decode('Modificacion de paqueteria con el ID :'.$pa->idpaqueterias));	
	}

	$db->commit();
	echo 1;
	
	
}catch(Exception $e){
	$db->rollback();
	$v = explode ('|',$e);
	// echo $v[1];
	 $n = explode ("'",$v[1]);
	 $n[0];
	$result = $db->m_error($n[0]);
	echo $result ;

}

?>