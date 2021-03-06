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

$result_niveles = $cd->todosNiveles();
$result_niveles_row = $db->fetch_assoc($result_niveles);

if(isset($_GET['ac']))
{
	if($_GET['ac']==1)
	{
		$msj='<div id="mens" class="alert_success">'.$_GET['msj'].'</div>';
	}
	else
	{
		$msj='<div id="mens" class="alert_error">Error. Intentar mas Tarde '.$_GET['ac'].'</div>';
	}

	echo '<script type="text/javascript">OcultarDiv(\'mens\')</script>';
    echo $msj;
}

?>

<script type="text/javascript">
	$('#titulo-modal-forms').html("ALTA A CLIENTE");
</script>

<form name="form_cliente" id="form_cliente">
	<div class="card">
		<div class="card-body" style="padding: 0">
			<!-- Nav tabs -->
			<ul class="nav nav-tabs" role="tablist">
				<li class="nav-item"> <a class="nav-link active" data-toggle="tab" href="#home" role="tab"><span class="hidden-sm-up"></span> <span class="hidden-xs-down">Datos Generales</span></a> </li>
				<li class="nav-item"> <a class="nav-link" data-toggle="tab" href="#profile" role="tab"><span class="hidden-sm-up"></span> <span class="hidden-xs-down">Datos Fiscales</span></a> </li>
				<li class="nav-item"> <a class="nav-link" data-toggle="tab" href="#messages" role="tab"><span class="hidden-sm-up"></span> <span class="hidden-xs-down">Datos de acceso</span></a> </li>
				<li class="nav-item"> <a class="nav-link" data-toggle="tab" href="#envio" role="tab"><span class="hidden-sm-up"></span> <span class="hidden-xs-down">Direcci&oacute;n de env&iacute;o</span></a> </li>
			</ul>
			<!-- Tab panes -->

			<div class="tab-content tabcontent-border" style="border: solid 1px #eaeaea; padding-top: 15px;">

				<div class="tab-pane active p-20" id="home" role="tabpanel">
					<div class="form-group m-t-20">
						<label>NIVEL:</label>
						<select name="v_nivel" id="v_nivel" title="Nivel" class="form-control">
						   <?PHP 
							  do
							  {
							?>
								<option value="<?php echo $result_niveles_row['idniveles'] ?>"><?php echo utf8_encode($result_niveles_row['nombre']);?></option>
							<?php
								}while($result_niveles_row = $db->fetch_assoc($result_niveles));
						   ?>
						</select>
					</div>

					<div class="row">
						<div class="col-md-6">
							<div class="form-group m-t-20">
								<label>SEXO:</label>
								<select name="v_sexo" id="v_sexo" title="sexo" class="form-control">
									<option value="H" selected="selected">HOMBRE</option>
									<option value="M">MUJER</option>
								</select>
							</div>	
						</div>
						<div class="col-md-6">
							<div class="form-group m-t-20">
								<label>FECHA DE NACIMIENTO:</label>
								<!--<input name="v_f_nacimiento" type="text" id="v_f_nacimiento" placeholder="06/11/2012" class="form-control">-->
								<div class="input-group">
									<input type="text" class="form-control" name="v_f_nacimiento" id="v_f_nacimiento" placeholder="yyyy-mm-dd">
									<div class="input-group-append">
										<span class="input-group-text"><i class="fa fa-calendar"></i></span>
									</div>
								</div>
							</div>
						</div>
					</div>


					<!--<div class="form-group m-t-20">
						<label>NO. DE TARJETA:</label>
						<input name="v_no_tarjeta" id="v_no_tarjeta" title="Tu Nombre" type="text" class="form-control" placeholder="No. de tarjeta"  required>
					</div>	-->

					<div class="form-group m-t-20">
						<label>NOMBRE:</label>
						<input name="v_nombre" id="v_nombren" title="Tu Nombre" type="text" class="form-control" placeholder="Ingresa tu Nombre"  required>
					</div>
					
					<div class="form-group m-t-20">
						<label>PATERNO:</label>
						<input name="v_paterno" id="v_paternon" title="Apellito Paterno" type="text" class="form-control" placeholder="Ingresa tu Apellido Paterno"  required>
					</div>
					
					<div class="form-group m-t-20">
						<label>MATERNO:</label>
						<input name="v_materno" id="v_maternon" title="Apellido Materno" type="text" class="form-control" placeholder="Ingresa tu Apellido Materno"  required>
					</div>					
					
					<div class="form-group m-t-20">
						<label>DIRECCION:</label>
						<textarea name="v_direccion" rows="5" required id="v_direccion" class="form-control" placeholder="Ingresa tu Direccion" title="Dirección"></textarea>
					</div>
					
					<div class="form-group m-t-20">
						<label>TEL&Eacute;FONO:</label>
						<input name="v_telefono" id="v_telefono" title="Telefono" type="text" class="form-control" placeholder="Ingresa tu No. Telefonico"  required>
					</div>
					
					<div class="form-group m-t-20">
						<label>FAX:</label>
						<input name="v_fax" id="v_fax" title="FAX" type="text" class="form-control" placeholder="Ingresa tu No. de Fax"  required>
					</div>
				</div>


				<div class="tab-pane  p-20" id="profile" role="tabpanel">
					<div class="form-group m-t-20">
						<label>RAZON SOCIAL:</label>
						<input name="v_fis_razonsocial" id="v_fis_razonsocial" title="Razon Social" type="text" class="form-control" placeholder="Ingresa tu Razon Social"  required>
					</div>

					<div class="form-group m-t-20">
						<label>RFC:</label>
						<input name="v_fis_rfc" id="v_fis_rfc" title="RFC" type="text" class="form-control" placeholder="Ingresa tu RFC"  required>
					</div>

					<div class="form-group m-t-20">
						<label>DIRECCION FISCAL:</label>
						<textarea name="v_fis_direccion" required id="v_fis_direccion" class="form-control" placeholder="Ingresa tu Direccion Fiscal" title="Direccion Fiscal"></textarea>
					</div>

					<div class="row">

						<div class="col-md-6">
							<div class="form-group m-t-20">
								<label>NO. INTERIOR:</label>
								<input name="v_fis_no_int" id="v_fis_no_int" title="Numero Interior Fiscal" type="text" class="form-control" placeholder="Ingresa tu No. Interior Fiscal"  required>
							</div>	
						</div>

						<div class="col-md-6">
							<div class="form-group m-t-20">
								<label>NO. EXTERIOR:</label>
								<input name="v_fis_no_ext" id="v_fis_no_ext" title="No. Ext. Fiscal" type="text" class="form-control" placeholder="Ingresa tu No. Exterior Fiscal"  required>
							</div>
						</div>
					</div>

					<div class="form-group m-t-20">
						<label>COLONIA FISCAL:</label>
						<input name="v_fis_col" id="v_fis_col" title="Colonia Fiscal" type="text" class="form-control" placeholder="Ingresa tu Colonia Fiscal"  required >
					</div>	

					<div class="form-group m-t-20">
						<label>CIUDAD FISCAL:</label>
						<input name="v_fis_ciudad" id="v_fis_ciudad" title="Ciudad Fiscal" type="text" class="form-control" placeholder="Tuxtla"  required>
					</div>

					<div class="form-group m-t-20">
						<label>ESTADO FISCAL:</label>
						<input name="v_fis_estado" id="v_fis_estado" title="El estado de tu direccion Fiscal" type="text" class="form-control" placeholder="Chiapas"  required>
					</div>	

					<div class="form-group m-t-20">
						<label>CP FISCAL:</label>
						<input name="v_fis_cp" id="v_fis_cp" title="El CP de tu direccion Fiscal" type="text" class="form-control" placeholder="Chiapas"  required>
					</div>
				</div>

				<div class="tab-pane p-20" id="messages" role="tabpanel">
					<div class="form-group m-t-20" style="display: none;">
						<label>USUARIO:</label>
						<input name="v_usuario" onBlur="validarUsuarioCliente();" id="v_usuario" title="Usuario" type="text" class="form-control" placeholder="Chiapas"  required>
					</div>
					
					<div class="form-group m-t-20">
						<label>EMAIL:</label>
						<input name="v_email" onchange="validarEmailCliente('');" id="v_email" title="Email" type="text" class="form-control" placeholder="Ingresa tu Email"  required>
						<span id="msj_error"></span>
					</div>
					
					<div class="form-group m-t-20">
						<label>CONTRASE&Ntilde;A:</label>
						<input name="v_clave" type="password"  id="v_clave" placeholder="1234" title="Clave" class="form-control">
					</div>
					
					<div class="form-group m-t-20">
						<label>ESTATUS:</label>
						<select name="v_estatus" id="v_estatus" title="Estatus" class="form-control">
							<option value="0" >NO ACTIVO</option>
							<option value="1" selected="selected">ACTIVO</option>
						</select>
					</div>
				</div>
				
				
				<div class="tab-pane p-20" id="envio" role="tabpanel">
					<div class="form-group m-t-20">
						<label>DIRECCI&Oacute;N DE ENV&Iacute;O:</label>
						<textarea name="v_direccion_envio" rows="5" required id="v_direccion_envio" class="form-control" placeholder="Ingresa tu Direccion" title="Dirección"></textarea>
					</div>
					
					<div class="form-group m-t-20">
						<label>CP:</label>
						<input name="v_cp" id="v_cp" title="CP" type="text" value="<?php echo $result_clientes['cp']?>" class="form-control" placeholder="CP"  required>
					</div>
					
				</div>



			</div>


			<div style="width: 100%;">
				<button type="button" onClick="var resp=MM_validateForm('v_nombren','','R','v_paternon','','R','v_maternon','','R','v_telefono','','isNum','v_email','','isEmail'); if(resp==1){ GuardarEspecial2('form_cliente','catalogos/ga_clientes.php','catalogos/vi_clientes.php','main')}" class="btn btn-success alt_btn3" style="float: right; margin-top: 10px;" <?php echo $disabled; ?> >GUARDAR</button>				
			</div>

		</div>
	</div>
</form>


<link rel="stylesheet" type="text/css" href="assets/libs/bootstrap-datepicker/dist/css/bootstrap-datepicker.min.css">
<script src="assets/libs/bootstrap-datepicker/dist/js/bootstrap-datepicker.min.js"></script>

<script>
	jQuery('#v_f_nacimiento').datepicker({
			format: 'yyyy-mm-dd',
            autoclose: true,
            todayHighlight: true
        });
</script>