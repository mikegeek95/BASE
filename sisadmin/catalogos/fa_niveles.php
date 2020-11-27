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


?>

<script type="text/javascript">
	$('#titulo-modal-forms').html("ALTA DE NIVELES");
</script>

<form id="alta_nivel" method="post" action="">
	<div class="card">
		<div class="card-body" style="padding: 0;">
			<!--<h5 class="card-title m-b-0"></h5>-->

			<div class="form-group m-t-20">
				<label>Nombre del Nivel:</label>
				<input type="text" name="nivel" id="nivel" class="form-control" title="Campo Nombre del Nivel" placeholder="Nombre del nivel" />
			</div>

			<div class="form-group m-t-20">
				<label>Estatus:</label>
				<select id="estatus" name="estatus" class="form-control">
					<option value="1" <?php if($datos['estatus']==1){echo 'selected="selected"';}?>>ACTIVADO</option>
					<option value="0" <?php if($datos['estatus']==0){echo '';}?>>DESACTIVADO</option>
				</select>
			</div>
		</div>
	</div>
		
	<div class="card">
		<div class="card-body" style="padding: 0;">
			<button type="button" onClick="var resp=MM_validateForm('categoria','','R'); if(resp==1){ GuardarEspecial2('alta_nivel','catalogos/ga_niveles.php','catalogos/vi_categorias_precios.php','main');}" class="btn btn-success" style="float: right;">GUARDAR</button>
		</div>
	</div>
</form>