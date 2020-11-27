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
require_once("../clases/class.Gastos.php");

$db = new MySQL();
$ga = new Gastos();
$ga->db = $db;

//id de gasto a modificar 

$ga->idgastos_categoria = $_GET['id'];

$gasto = $ga->ObtenerInformacionGasto();


?>

<form id="form_gastos" method="post" action="">
	<div class="card">
		<div class="card-body">
			<h5 class="card-title m-b-0">ALTA DE CONCEPTO DE GASTO</h5>

			<div style="padding: 20px;">
				<button type="button" onClick="aparecermodulos('catalogos/vi_gastos.php','main');" class="btn btn-primary" style="float: right;">Ver Conceptos de Gastos</button>
				<div style="clear: both;"></div>
			</div>

			<div class="form-group m-t-20">
				<label>Tipo:</label>
				<select name="v_tipo" id="v_tipo" title="Tipo de Gasto" class="form-control">
					<option value="0" <?php if($gasto['tipo'] == 0){ echo 'selected="selected"';  } ?> selected="selected">FIJO</option>
					<option value="1" <?php if($gasto['tipo'] == 1){ echo 'selected="selected"';  } ?>>VIATICOS</option>                                  
				</select>
			</div>

			<div class="form-group m-t-20">
				<label>Gasto:</label>
				<input name="v_gasto" id="v_gasto" title="Titulo del Gasto" type="text" class="form-control" placeholder="Renta de Local" value="<?php echo $gasto['categoria']; ?>"  required>
			</div>
			
			<div class="form-group m-t-20">
				<label>Concepto del Gasto:</label>
				<input name="v_descripcion" id="v_descripcion" title="Descripcion del Gasto" type="text" class="form-control" placeholder="Renta de solamente Locales comerciales" value="<?php echo $gasto['descripcion']; ?>"  required>
			</div>
			
			<div class="form-group m-t-20">
				<label>Estatus:</label>
				<select name="v_estatus" id="v_estatus" class="form-control">
				  <option value="0"  <?php if($gasto['estatus'] == 0){ echo 'selected'; }?> >Desactivado</option>
				  <option value="1" <?php if($gasto['estatus'] == 1){ echo 'selected'; }?>>Activado</option>
				</select>
			</div>
		</div>
	</div>
	
	<div class="card">
		<div class="card-body">
			<input type="hidden" name="id" id="id" value="<?php echo $_GET['id']; ?>">
			<button type="button" onClick="var resp=MM_validateForm('v_gasto','','R','v_descripcion','','R','v_codigo','','R'); if(resp==1){  GuardarEspecial('form_gastos','catalogos/md_gasto.php','catalogos/vi_gastos.php','main'); }" class="btn btn-primary alt_btn" style="float: right;" <?php echo $disabled; ?>>Guardar</button>
		</div>
	</div>
</form>