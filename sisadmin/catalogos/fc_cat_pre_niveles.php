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
   
   $cd->db = $db;
   
   $idcategoria_precio = $_GET['idcategoria_precio'];
   $idniveles = $_GET['idniveles'];
   
   $cd->idniveles = $idniveles;
   $cd->idcategoria_precio = $idcategoria_precio;
   
   $result_categorias = $cd->todasCategoriasPrecio();
   $result_categorias_row = $db->fetch_assoc($result_categorias);
   
   $result_niveles = $cd->todosNiveles();
   $result_niveles_row = $db->fetch_assoc($result_niveles);


	$result = $cd->buscarCategoriaPrecioNiveles();
	$result_row = $db->fetch_assoc($result);
		
?>


<script type="text/javascript">
	$('#titulo-modal-forms').html("ALTA DE CATEGORIA");
</script>

<form id="alta_categoria" method="post" action="">
	<div class="card">
		<div class="card-body" style="padding: 0;">
			<!--<h5 class="card-title m-b-0"></h5>-->

			<div class="form-group m-t-20">
				<label>Categoria:</label>
				<select id="categoria" name="categoria" class="form-control">
					<?php
					do
					{ 
						if($result_categorias_row['estatus'] != 0){
					?>
					<option value="<?php echo $result_categorias_row['idcategoria_precio'] ?>" <?php if($result_row['idcategoria_precio'] == $result_categorias_row['idcategoria_precio']){ echo "selected";} ?> ><?php echo utf8_encode($result_categorias_row['nombre']); ?></option>
					<?php
						}
					}while($result_categorias_row = $db->fetch_assoc($result_categorias));
					?>
				</select>
			</div>

			<div class="form-group m-t-20">
				<label>Nivel:</label>
				<select id="nivel" name="nivel" class="form-control">
					<?php
					do
					{ 
						if($result_niveles_row['estatus'] != 0){
					?>
					<option value="<?php echo $result_niveles_row['idniveles'] ;?>" <?php if($result_row['idniveles'] == $result_niveles_row['idniveles']){ echo "selected";} ?> ><?php echo utf8_encode($result_niveles_row['nombre']); ?></option>
					<?php
						}
					}while($result_niveles_row = $db->fetch_assoc($result_niveles));
					?>
				</select>
			</div>
			
			<!--<div class="form-group m-t-20">
				<label>Porc. Descuento:</label>
				<select id="descuento" name="descuento" class="form-control" style="width: 95%; float: left;">
					<?php
						for($x=0;$x<=100;$x++){
							/*if($x<10){
								$x = "0".$x;
							}*/
					?>
					<option value="<?php echo $x; ?>" <?php if($result_row['descuento'] == $x){ echo "selected";} ?> ><?php echo $x; ?></option>
					<?php
						}
					?>
				</select><label style="position: relative; top: 6px; left: 15px; display: block; padding: 0;">%</label>
				
				<div style="clear: both;"></div>
			</div>-->
			
			<div class="input-group m-t-20">
				 <label>Porc. Descuento:</label>
    			<select id="descuento" name="descuento" class="form-control" style="width: 95%; float: left;">
					<?php
						for($x=0;$x<=100;$x++){
							/*if($x<10){
								$x = "0".$x;
							}*/
					?>
					<option value="<?php echo $x; ?>" <?php if($result_row['descuento'] == $x){ echo "selected";} ?> ><?php echo $x; ?></option>
					<?php
						}
					?>
				</select>
				<div class="input-group-prepend">
      				<div class="input-group-text">%</div>
    			</div>
  			</div>
			
		</div>
	</div>
		
	<div class="card">
		<div class="card-body" style="padding: 0;">
			<input type="hidden" name="idniveles" id="idniveles" value="<?php echo $idniveles; ?>" />
            <input type="hidden" name="idcategoria_precio" id="idcategoria_precio" value="<?php echo $idcategoria_precio; ?>" />
			<button type="button" onClick="GuardarEspecial2('alta_categoria','catalogos/md_cat_pre_niveles.php','catalogos/vi_categorias_precios.php','main');" class="btn btn-success" style="float: right;">GUARDAR</button>
			
			<button type="button" onClick="BorrarDatosCategoriaPreciosNiveles('<?php echo $idcategoria_precio; ?>','<?php echo $idniveles ?>','idniveles','niveles','n','catalogos/vi_categorias_precios.php','main')" class="btn btn-danger" style="float: right; margin-right: 15px;">ELIMINAR</button>			
		</div>
	</div>
</form>