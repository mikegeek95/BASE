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
   require_once("../clases/class.Categoria_Descuento.php");
   
   $db = new MySQL();
   $cd = new categoria_descuento();
  
   $id = $_GET['id'];
   
   $cd->db = $db;
   $cd->idniveles = $id;
   
   $result_categorias = $cd->buscarNivel();
   $result_categorias_row = $db->fetch_assoc($result_categorias);
   $result_categorias_num = $db->num_rows($result_categorias);
   
   
   $nombre = utf8_encode($result_categorias_row['nombre']);


?>

<script type="text/javascript">
	$('#titulo-modal-forms').html("MODIFICAR NIVELES");
</script>

<form id="alta_nivel" method="post" action="">
	<div class="card">
		<div class="card-body" style="padding: 0;">
			<!--<h5 class="card-title m-b-0"></h5>-->

			<div class="form-group m-t-20">
				<label>Nombre del Nivel:</label>
				<input type="text" name="nivel" id="nivel" class="form-control" title="Campo Nombre del Nivel" placeholder="nombre del nivel" value="<?php echo $nombre; ?>" />
			</div>

			<div class="form-group m-t-20">
				<label>Estatus:</label>
				<select id="estatus" name="estatus" class="form-control">
					<option value="1" <?php if($result_categorias_row['estatus']==1){echo 'selected="selected"';}?>>ACTIVADO</option>
					<option value="0" <?php if($result_categorias_row['estatus']==0){echo 'selected="selected"';}?>>DESACTIVADO</option>
				</select>
			</div>
		</div>
	</div>
		
	<div class="card">
		<div class="card-body" style="padding: 0;">
			<input type="hidden" name="id" id="id" value="<?php echo $id; ?>" />
			<button type="button" onClick="var resp=MM_validateForm('nivel','','R'); if(resp==1){ GuardarEspecial2('alta_nivel','catalogos/md_niveles.php','catalogos/vi_categorias_precios.php','main');}" class="btn btn-success" style="float: right;">GUARDAR</button>
			
			<button type="button" onClick="BorrarDatos2('<?php echo $id; ?>','idniveles','niveles','n','catalogos/vi_categorias_precios.php','main')" class="btn btn-danger" style="float: right; margin-right: 10px;">ELIMINAR</button>
		</div>
	</div>
</form>