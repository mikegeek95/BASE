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
$db = new MySQL();




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
					<option value="0" selected="selected">FIJO</option>
					<option value="1">VIATICOS</option>                                  
				</select>
			</div>

			<div class="form-group m-t-20">
				<label>Gasto:</label>
				<input name="v_gasto" id="v_gasto" title="Titulo del Gasto" type="text" class="form-control" placeholder="Renta de Local"  required>
			</div>
			
			<div class="form-group m-t-20">
				<label>Concepto del Gasto:</label>
				<input name="v_descripcion" id="v_descripcion" title="Descripcion del Gasto" type="text" class="form-control" placeholder="Renta de solamente Locales comerciales"  required>
			</div>
		</div>
	</div>
	
	<div class="card">
		<div class="card-body">
			<button type="button" onClick="var resp=MM_validateForm('v_gasto','','R','v_descripcion','','R','v_codigo','','R'); if(resp==1){  GuardarEspecial('form_gastos','catalogos/ga_gasto.php','catalogos/vi_gastos.php','main'); }" class="btn btn-primary alt_btn" style="float: right;" <?php echo $disabled; ?>>Guardar</button>
		</div>
	</div>
</form>