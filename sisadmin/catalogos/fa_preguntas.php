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
require_once("../clases/class.Preguntas.php");

$db = new MySQL();
$pa = new Preguntas();

$pa->db = $db;

if(isset($_GET['idpreguntas']))
{
	$idpreguntas = $_GET['idpreguntas'];
	
	$pa->idpregunta = $idpreguntas;
	
	$result_paqueteria = $pa->buscar_pregunta();
	$result_paqueteria_row = $db->fetch_assoc($result_paqueteria);
	
	
	$pregunta = $result_paqueteria_row['pregunta'];

	$respuesta = $result_paqueteria_row['respuesta'];
	
	$estatus = $result_paqueteria_row['estatus'];
	
	
}else{
	$pregunta = "";

	$respuesta = "";
	
	$estatus = 1;
	
	
	$idpreguntas = 0;
}


?>

<form id="alta_preguntas" method="post" action="">
	<div class="card mb-3">
		<div class="card-header">
			<h5 class="card-title" style="float: left; margin-top: 5px;">ALTA DE PREGUNTA</h5>
			<button type="button" onClick="aparecermodulos('catalogos/vi_preguntas.php','main');" class="btn btn-info" style="float: right;">VER PREGUNTAS</button>
			<div style="clear: both;"></div>
		</div>
	</div>
	
	<div class="card mb-3">
		<div class="card-header">
			<h5 class="card-title" style="float: left; margin-top: 5px;">DATOS GENERALES</h5>
		</div>
		
		<div class="card-body">
			<div class="form-group m-t-20">
				<label>Pregunta:</label>
				<input type="text" name="pregunta" id="pregunta" class="form-control" title="Campo Pregunta" value="<?php echo $pregunta; ?>" placeholder="Pregunta" />
			</div>

			
			
			<div class="form-group m-t-20">
				<label>Respuesta:</label>
			
			<textarea  name="respuesta" id="respuesta" class="form-control"  rows="10" title="Campo Respuesta" placeholder="Respuesta"><?php echo $respuesta; ?></textarea>
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
			<input type="hidden" id="idpregunta" name="idpregunta" value="<?php echo $idpreguntas ?>" />
			<button type="button" onClick="var resp=MM_validateForm('pregunta','','R','respuesta','','R'); if(resp==1){ GuardarEspecial('alta_preguntas','catalogos/ga_preguntas.php','catalogos/vi_preguntas.php','main');}" class="btn btn-success alt_btn" style="float: right;" <?php echo $disabled; ?>>GUARDAR</button>
	  	</div>
	</div>
</form>