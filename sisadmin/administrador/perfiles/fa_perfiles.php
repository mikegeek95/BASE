<?php
require_once("../../clases/class.Sesion.php");
//creamos nuestra sesion.
$se = new Sesion();

$idmenu=$_GET['idmenumodulo'];

if(!isset($_SESSION['se_SAS']))
{
	header("Location: ../../login.php");
	exit;
}

require_once("../../clases/conexcion.php");
require_once("../../clases/class.PerfilesPermisos.php");
require_once("../../clases/class.Funciones.php");

try
{
	$db= new MySQL();
	$pp = new PerfilesPermisos();
	$fu = new Funciones();
	
	$pp->db = $db;
	if(isset($_GET['id'])){
	$titulo=$fu->imprimir_cadena_utf8("MODIFICACIÓN DE PERFIL");
	$idperfil=$_GET['id'];
	$pp->idperfiles=$idperfil;
	$datos=$pp->ObtenerInfoPerfil();//datos del ferfil
	
	$arrayMenus=$pp->ObtenerMenusPerfil();//cadena con todos los permisos de este perfil
	$perfil=$fu->imprimir_cadena_utf8($datos['perfil']);
		$estatus=$datos['estatus'];
		$tipo=2;
	}
	else{
		$titulo=$fu->imprimir_cadena_utf8("ALTA DE PERFIL");
		$idperfil=0;
		$perfil=$fu->imprimir_cadena_utf8("");
		$estatus="";
		$tipo=1;
		$arrayMenus=0;
	}
	$query="SELECT * FROM modulos WHERE estatus=1";
	$resp=$db->consulta($query);
	$rows=$db->fetch_assoc($resp);
	$total=$db->num_rows($resp);
	
	$disabled='';
?>

<form id="alta_perfil" method="post" action="">
	<div class="card">
		
		<div class="card-header">
			<h5 class="font-weight-bold text-primary m-b-0" style="float: left;"><?php echo ($titulo);?></h5>
			<button type="button" onClick="aparecermodulos('administrador/perfiles/vi_perfiles.php?idmenumodulo=<?php echo ($idmenu);?>','main');" class="btn btn-outline-primary" style="float: right;"><i class="fas fa-undo"></i> Ver Perfiles</button>
			<div style="clear: both;"></div>
		</div>
		
		<div class="card-body row">
			<div class="form-group m-t-20 col-12 col-sm-12 col-md-6 col-lg-6 col-xl-6">
				<label>Nombre del Perfil:</label>
				<input type="text" name="nombre" id="nombre" class="form-control" title="Nombre" placeholder="Nombre" value="<?php echo $perfil; ?>" />
			</div>

			<div class="form-group m-t-20 col-12 col-sm-12 col-md-6 col-lg-6 col-xl-6">
				<label>Estatus :</label>
				<select id="estatus" name="estatus" class="form-control">
					<option <?php if($estatus==1){echo 'selected="selected"';}?> value="1">Activo</option>
					<option <?php if($estatus==0){echo 'selected="selected"';}?> value="0">Inactivo</option>
				</select>
			</div>
		</div>
	</div>
	
	<div class="card">
		<div class="card-header">
			<h5 class="font-weight-bold text-primary m-b-0" style="float: left;">MEN&Uacute;S</h5>
			<input type="hidden" name="tipo" id="tipo" value="1" /> 
		</div>
		<div class="card-body">
    		<fieldset>
				<label class="width_full"><span id="requerido">&bull;</span>Selecciona los men&uacute;s a los cuales va a tener permisos este perfil</label>
				<br>
				<label class="width_full"><span id="requerido">&bull;</span>A: Alta. M: Modificaci&oacute;n. E: Eliminaci&oacute;n</label>
			</fieldset>
			
			<div class="row">
				<?php
            	if($total==0)
				{
					$disabled='disabled="disabled"';
				?>
					<div class="col-md-12">
						<p align="center">No Existen Modulos disponibles para crear Perfiles</p>
					</div>
                <?php
				}else{
					$contador_menus=0;
					do
					{
				?>
						<div class="col-lg-4" style="margin-bottom: 10px;">
							<div class="card mb-4 py-3 border-left-primary border-bottom-primary">
								<h5 style="margin: 0; padding: 0;  margin-left: 15px">  <i class="<?php echo $fu->imprimir_cadena_utf8($rows['icono']);?>"></i>  <?php echo $fu->imprimir_cadena_utf8($rows['modulo']);?></h5>
								<p>
							  <button class="btn btn-outline-primary" type="button" data-toggle="collapse" data-target="#collapsepermiso<?php echo $fu->imprimir_cadena_utf8($rows['idmodulos']);?>" aria-expanded="false" aria-controls="collapsepermiso<?php echo $fu->imprimir_cadena_utf8($rows['idmodulos']);?>" style="float: right;margin-right: 50px;  margin-top: -25px;">
								<i class="fas fa-chevron-down"></i>
							  </button>
							</p>
								
								<?php
								$querym="SELECT * FROM modulos_menu WHERE estatus=1 AND idmodulos=".$rows['idmodulos'];
								
								$respm=$db->consulta($querym);
								$rowsm=$db->fetch_assoc($respm);
								$totalm=$db->num_rows($respm);

								if($totalm==0)
								{
									?><div class="collapse" id="collapsepermiso<?php echo $fu->imprimir_cadena_utf8($rows['idmodulos']);?>">
										<?php	echo 'No existen menus disponibles '; ?>
									</div>
								<?php
								}
								else
								{
									$header_tbl = '';
									$line_height = 'line-height:46px;';
									do
									{	if($arrayMenus!=0){
										for($i=0;$i<count($arrayMenus);$i++)
										{
											$datos_array = explode("|",$arrayMenus[$i]);
											if($datos_array[0]==$rowsm['idmodulos_menu'])
											{
												$cheked='checked="checked"';
												
												if($datos_array[1] == 1){
													$cheked_insert = "checked";
												}
												
												if($datos_array[2] == 1){
													$cheked_update = "checked";
												}
												
												if($datos_array[3] == 1){
													$cheked_delete = "checked";
												}
												
												
												break;
											}
											else
											{
												$cheked="";
												$cheked_insert = "";
												$cheked_update = "";
												$cheked_delete = "";
											}
											
										}
									}else{
										$cheked="";
												$cheked_insert = "";
												$cheked_update = "";
												$cheked_delete = "";
									}
										$contador_menus=$contador_menus+1;
										?>
										<div class="collapse" id="collapsepermiso<?php echo $fu->imprimir_cadena_utf8($rows['idmodulos']);?>">
										<hr style="margin-top: 5px;"></hr>
										<div class="row" style="padding: 5px 0;  margin-left: 15px">
											<div class="col-sm-6" style="<?php echo $line_height; ?>">
												<input type="checkbox" name="menu<?php echo $contador_menus;?>" <?php echo $cheked;?> id="menu<?php echo $contador_menus;?>" value="<?php echo $rowsm['idmodulos_menu'];?>" />  <i class="<?php echo $fu->imprimir_cadena_utf8($rowsm['icono']);?>"></i>  <?php echo $fu->imprimir_cadena_utf8($rowsm['menu']);?><br />
											</div>
											
											<div class="col-sm-6">
												<table style="width: 100%;">
													<tr style="<?php echo $header_tbl; ?>">
														<td style="width: 33%;">A</td>
														<td style="width: 33%;">M</td>
														<td style="width: 33%;">E</td>
													</tr>
													<tr>
														<td><input type="checkbox" name="insertar<?php echo $contador_menus;?>" <?php echo $cheked_insert; ?> id="insertar<?php echo $contador_menus;?>" value="1" /></td>
														<td><input type="checkbox" name="modificar<?php echo $contador_menus;?>" <?php echo $cheked_update; ?> id="modificar<?php echo $contador_menus;?>" value="1" /></td>
														<td><input type="checkbox" name="borrar<?php echo $contador_menus;?>" <?php echo $cheked_delete; ?> id="borrar<?php echo $contador_menus;?>" value="1" /></td>
													</tr>
												</table>
											</div>
										</div>
									</div>
									<?php
										$header_tbl = 'display:none;';
										$line_height = '';
									}while($rowsm=$db->fetch_assoc($respm));
								}
								?>
							</div>
						</div>
                    <?php
					}while($rows=$db->fetch_assoc($resp));					
				}
				?>            
			</div>
		</div>
	</div>
	
	<div class="card">
		<div class="card-body">
			<input type="hidden" name="tipo" id="tipo" value="<?php echo ($tipo);?>" />
   			<input type="hidden" name="idperfiles" id="idperfiles" value="<?php echo $idperfil?>" />
			<input type="hidden" name="cantidad_menu" id="cantidad_menu" value="<?php echo $contador_menus;?>" />
			<button type="button" onClick="GuardarEspecialPerfiles('alta_perfil','administrador/perfiles/ga_perfiles.php','administrador/perfiles/vi_perfiles.php?idmenumodulo=<?php echo ($idmenu);?>','main');" class="btn btn-outline-success alt_btn alt_btn" style="float: right;" <?php echo $disabled; ?>><i class="far fa-save"></i> Guardar</button>
		</div>
	</div>
</form> 
<?php
}
catch(Exception $e)
{
	echo $e;
}
?>
<script type="text/javascript"	src="js/validaciones/perfiles.js"></script>