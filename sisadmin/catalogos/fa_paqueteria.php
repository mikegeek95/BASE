<?php
header("Content-Type: text/text; charset=ISO-8859-1");
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

$db = new MySQL();
$pa = new Paqueterias();

$pa->db = $db;

if(isset($_GET['idpaqueterias']))
{
	$idpaqueterias = $_GET['idpaqueterias'];
	
	$pa->idpaqueterias = $idpaqueterias;
	
	$result_paqueteria = $pa->buscar_paqueteria();
	$result_paqueteria_row = $db->fetch_assoc($result_paqueteria);
	
	
	$nombre = $result_paqueteria_row['nombre'];
	$direccion = $result_paqueteria_row['direccion'];
	$email = $result_paqueteria_row['email'];
	$tel = $result_paqueteria_row['tel'];
	$estatus = $result_paqueteria_row['estatus'];
	$urlrastreo = $result_paqueteria_row['urlrastreo'];
	
}else{
	$nombre = "";
	$direccion = "";
	$email = "";
	$tel = "";
	$estatus = 1;
	$urlrastreo = "";
	
	$idpaqueterias = 0;
}


?>

<form id="alta_paqueteria" method="post" action="">
	<div class="card mb-3">
		<div class="card-header">
			<h5 class="card-title" style="float: left; margin-top: 5px;">ALTA DE PAQUETER&Iacute;A</h5>
			<button type="button" onClick="aparecermodulos('catalogos/vi_paqueteria.php','main');" class="btn btn-info" style="float: right;">VER PAQUETER&Iacute;AS</button>
			<div style="clear: both;"></div>
		</div>
	</div>
	
	<div class="card mb-3">
		<div class="card-header">
			<h5 class="card-title" style="float: left; margin-top: 5px;">DATOS GENERALES</h5>
		</div>
		
		<div class="card-body">
			<div class="form-group m-t-20">
				<label>Nombre:</label>
				<input type="text" name="nombre" id="nombre" class="form-control" title="Campo Nombre de la paqueter&iacute;a" value="<?php echo $nombre; ?>" placeholder="Nombre de la paqueter&iacute;a" />
			</div>

			<div class="form-group m-t-20">
				<label>Direcci&oacute;n:</label>
				<textarea placeholder="7a oriente entre 1ra y 2a sur" name="direccion" id="direccion" class="form-control"><?php echo $direccion; ?></textarea>
			</div>
			
			<div class="form-group m-t-20">
				<label>Tel&eacute;fono:</label>
				<input type="text" name="telefono" id="telefono" class="form-control" title="Campo Tel&eacute;fono Del Proveedor" value="<?php echo $tel; ?>" placeholder="9611234567" />
			</div>
			
			<div class="form-group m-t-20">
				<label>E-mail:</label>
				<input type="text" name="email" id="email" class="form-control" title="Campo E-mail Del Proveedor" value="<?php echo $email; ?>" placeholder="email@ejemplo.com.mx" />
			</div>
			
			<div class="form-group m-t-20">
				<label>Url de rastreo:</label>
				<input type="text" name="urlrastreo" id="urlrastreo" class="form-control" title="Campo Url de rastreo" value="<?php echo $urlrastreo; ?>" placeholder="https://www.estafeta.com/Herramientas/Rastreo" />
			</div>
			
			<div class="form-group m-t-20">
				<label>Estatus:</label>
				<select name="estatus" id="estatus" class="form-control">
					<option <?php if($estatus == 0){ echo "selected"; } ?> value="0">DESACTIVADO</option>
					<option <?php if($estatus == 1){ echo "selected"; } ?> value="1">ACTIVADO</option>
				</select>
			</div>
		</div>
		
		<div class="card-footer text-muted">
			<input type="hidden" id="idpaqueterias" name="idpaqueterias" value="<?php echo $idpaqueterias ?>" />
			<button type="button" onClick="var resp=MM_validateForm('nombre','','R','telefono','','isNum','email','','RisEmail'); if(resp==1){ GuardarEspecial('alta_paqueteria','catalogos/ga_paqueteria.php','catalogos/vi_paqueteria.php','main');}" class="btn btn-success alt_btn" style="float: right;" <?php echo $disabled; ?>>GUARDAR</button>
	  	</div>
	</div>
</form>