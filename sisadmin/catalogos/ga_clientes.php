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
require_once("../clases/class.Clientes.php");
require_once('../clases/class.MovimientoBitacora.php');
require_once('../clases/class.Funciones.php');


try
{
	$db= new MySQL();
	$cli= new Clientes();
	$f = new Funciones();
	$md = new MovimientoBitacora();
	
	$cli->db = $db;
	$md->db = $db;
		
	
	$idsucursales = $_SESSION['se_sas_Sucursal'];

	
	$db->begin();
	
	//enviamos datos a las variables de la tablas	
	
	//die($_POST['v_descuento']."s");
	
	if($_POST['v_f_nacimiento'] == ""){
		$f_nacimiento = "1900-12-12";
	}else{
		$f_nacimiento = trim($_POST['v_f_nacimiento']);
	}
	
	$cli->no_tarjeta = trim($f->guardar_cadena_utf8($_POST['v_no_tarjeta']));
	$cli->nombre = trim($f->guardar_cadena_utf8(($_POST['v_nombre'])));
	$cli->paterno = trim($f->guardar_cadena_utf8(($_POST['v_paterno'])));
	$cli->materno = trim($f->guardar_cadena_utf8(($_POST['v_materno'])));
	$cli->direccion = trim($f->guardar_cadena_utf8(($_POST['v_direccion'])));
	$cli->telefono = trim($f->guardar_cadena_utf8(($_POST['v_telefono'])));
	$cli->fax = trim($f->guardar_cadena_utf8(($_POST['v_telefono'])));
	$cli->email = trim($f->guardar_cadena_utf8(($_POST['v_email'])));
	$cli->sexo = trim($f->guardar_cadena_utf8(($_POST['v_sexo'])));
	$cli->usuario = trim($f->guardar_cadena_utf8(($_POST['v_usuario'])));
	$cli->clave = trim($f->guardar_cadena_utf8(($_POST['v_clave'])));
	$cli->estatus = trim($f->guardar_cadena_utf8(($_POST['v_estatus'])));
	$cli->direccion_envio = trim($f->guardar_cadena_utf8(($_POST['v_direccion_envio'])));
	$cli->cp = $_POST['v_cp'];
	
	//$cli->f_nacimiento = trim(utf8_decode($_POST['v_f_nacimiento']));
	$cli->f_nacimiento = $f_nacimiento;
	$cli->descuento = trim($f->guardar_cadena_utf8(($_POST['v_descuento'])));
	$cli->nivel = trim($_POST['v_nivel']);
	$cli->idsucursales = $idsucursales;
	
	
	//variables de lo fiscal
	
	$cli->fis_razonsocial = trim(utf8_decode($_POST['v_fis_razonsocial']));
	$cli->fis_rfc = trim(utf8_decode($_POST['v_fis_rfc']));
	$cli->fis_direccion = trim(utf8_decode($_POST['v_fis_direccion']));
	$cli->fis_no_ext = trim(utf8_decode($_POST['v_fis_no_ext']));
	$cli->fis_no_int = trim(utf8_decode($_POST['v_fis_no_int']));
	$cli->fis_cp = trim(utf8_decode($_POST['v_fis_cp']));
	$cli->fis_estado = trim(utf8_decode($_POST['v_fis_estado']));
	$cli->fis_ciudad = trim(utf8_decode($_POST['v_fis_ciudad']));
	$cli->fis_col= trim(utf8_decode($_POST['v_fis_col']));

	
	
	
	//guardando
	$cli->GuardarNewCliente();

	$md->guardarMovimiento(utf8_decode('Clientes'),'cliente',utf8_decode('Nuevo Cliente creado con el ID :'.$cli->ultimoIDCliente));
	
	$db->commit();
	echo 1;
	echo("|".$cli->ultimoIDCliente);
	
	
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