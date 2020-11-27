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
require_once("../clases/class.Preguntas.php");
require_once('../clases/class.MovimientoBitacora.php');

try

{

	$db = new MySQL();
	$pa = new Preguntas();
	$md = new MovimientoBitacora();
	
	$pa->db = $db;
	$md->db = $db;
	
	$db->begin();

	
	//enviamos datos a las variables de la tablas	
	$pa->pregunta = utf8_decode($_POST['pregunta']);
	$pa->respuesta = utf8_decode($_POST['respuesta']);
	$pa->estatus = $_POST['estatus'];
	$pa->idpregunta = $_POST['idpregunta'];
	
	
	if($pa->idpregunta == 0){
		//guardando
		$pa->guardar_pregunta();
		$md->guardarMovimiento(utf8_decode('preguntas'),'preguntas',utf8_decode('Nueva pregunta creado con el ID :'.$pa->idpregunta));	
	}else{
		$pa->modificar_pregunta();
		$md->guardarMovimiento(utf8_decode('preguntas'),'preguntas',utf8_decode('Modificacion de pregunta con el ID :'.$pa->idpregunta));	
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