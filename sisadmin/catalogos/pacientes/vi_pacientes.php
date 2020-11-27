<?php
     
require_once("../../clases/class.Sesion.php");
//creamos nuestra sesion.
$se = new Sesion();


if(!isset($_SESSION['se_SAS']))
{
	header("Location: ../../login.php");
	exit;
}
     require_once("../../clases/conexcion.php");
	 
	 $db = new MySQL();
	 
	 $sql_cliente = "SELECT * FROM clientes";
	// $result_cliente = $db->consulta($sql_cliente);
	 $result_row = $db->fetch_assoc($sql_cliente);
	 $result_row_num = $db->num_rows($sql_cliente);


if(isset($_GET['ac']))
{
	if($_GET['ac']==1)
	{
		$msj='<div id="mens" class="alert alert-success" role="alert">'.$_GET['msj'].'</div>';
	}
	else
	{
		$msj='<div id="mens" class="alert alert-danger" role="alert">Error. Intentar mas Tarde '.$_GET['msj'].'</div>';
	}
	
	echo '<script type="text/javascript">OcultarDiv(\'mens\')</script>';
	
	echo $msj;
}

 
 ?>
 
<script type="text/javascript" charset="utf-8">

//$(document).ready(function() {

var oTable = $('#zero_config').dataTable( {		

	  "oLanguage": {
					"sLengthMenu": "Mostrar _MENU_ Registros por p&aacute;gina",
					"sZeroRecords": "Nada Encontrado - Disculpa",
					"sInfo": "Mostrar _START_ a _END_ de _TOTAL_ Registros",
					"sInfoEmpty": "desde 0 a 0 de 0 records",
					"sInfoFiltered": "(filtered desde _MAX_ total Registros)",
					"sSearch": "Buscar",
					"oPaginate": {
								 "sFirst":    "Inicio",
								 "sPrevious": "Anterior",
								 "sNext":     "Siguiente",
								 "sLast":     "&Uacute;ltimo"
								 }
					},
	   "sPaginationType": "full_numbers",
});
//});

</script>
  

<div class="card mb-3">
	<div class="card-header">
		<h5 class="card-title" style="float: left; margin-top: 5px;">LISTA DE CLIENTES</h5>
		<button data-toggle="modal" data-target="#extraLargeModal" type="button" onClick="AbrirModalGeneral2('ModalPrincipal','900','560','catalogos/fa_cliente.php');" class="btn btn-info" style="float: right;">AGREGAR CLIENTE</button>
		<div style="clear: both;"></div>
	</div>
	<div class="card-body">
		<form action="" name="filtro" id="filtro">
			<div class="row">
				

				<div class="col-md-3">
					<div class="form-group">
						<label>NOMBRE:</label>
						<input class="form-control" type="text" id="v_nombre" name="v_nombre">
					</div>
				</div><div class="col-md-3">
					<div class="form-group">
						<label>PATERNO:</label>
						<input class="form-control" type="text" id="v_paterno" name="v_paterno">
					</div>
				</div><div class="col-md-3">
					<div class="form-group">
						<label>MATERNO:</label>
						<input class="form-control" type="text" id="v_materno" name="v_materno">
					</div>
				</div>
					<div class="col-md-3">
					<div class="form-group">
						<label>EMAIL:</label>
						<input class="form-control" type="text" id="v_email" name="v_email">
					</div>
				</div>
				<div class="col-md-3">
					<div class="form-group">
						<label>SEXO:</label>
						<select name="v_sexo" id="v_sexo" class="form-control">
							<option value="">Seleccione una opcion</option>
							<option value="H">HOMBRE</option>
							<option value="M">MUJER</option>

						</select>
					</div>
				</div>

				<div class="col-md-3">
					<div class="form-group">
						<label>ESTATUS:</label>
						<select name="v_estatus" id="v_estatus" class="form-control">
							<option value="">TODOS</option>
							<option value="1">ACTIVOS</option>
							<option value="0">INACTIVOS</option>
						</select>
					</div>
				</div>
			</div>
		</form>
	</div>

	<div class="card-footer text-muted" style="text-align: right;">
		<input type="button" value="BUSCAR" class="btn btn-info" onClick="buscarclientes('filtro');" style="margin-top: 5px;" >
	</div>
</div>
  	<div class="card-body">
		<div class="table-responsive" id="contenedor-clientes">
			<table id="zero_config" class="table table-bordered table-hover" cellpadding="0" cellspacing="0">
				<thead>
					<tr>
						<th width="20">ID CLIENTE</th> 
						<th>NOMBRE</th>
						<th>NIVEL</th>
						<!--<th>NO TARJETA</th>-->
						<th>TELEFONO</th>
						<th>M. VIRTUAL</th>
						<!--<th>USUARIO</th>-->
						<th width="40">EMAIL</th>
						<th>CLAVE</th>
						<th>SUCURSAL</th>
						<th>ACCI&Oacute;N</th>
					</tr>
				</thead>
				<tbody>
					<?php
					if( $result_row_num  != 0)
					{
						do
						{
							$idniveles = $result_row['idniveles'];

							$sql = "SELECT * FROM niveles WHERE idniveles = '$idniveles'";
							$result_nivel = $db->consulta($sql);
							$result_nivel_row = $db->fetch_assoc($result_nivel);
							$result_nivel_num = $db->num_rows($result_nivel);

							if($result_nivel_num == 0){
								$nivel = "0";
							}else{
								$nivel = $result_nivel_row['nombre'];
							}

							$idsucursal = $result_row['idsucursales'];

							$sql_sucursal = "SELECT * FROM sucursales WHERE idsucursales = '$idsucursal'";
							$result_sucursal = $db->consulta($sql_sucursal);
							$result_sucursal_row = $db->fetch_assoc($result_sucursal);
					?>

						<tr> 
						  	<td width="20" style="text-align:center;"><?php echo $result_row['idcliente']; ?></td> 
						  	<td><?php echo $result_row['nombre']." ".$result_row['paterno']." ".$result_row['materno']; ?></td>
						  	<td><?php echo $nivel; ?></td>
						  	
						  	<td><a href="tel://<?php echo utf8_encode($result_row['telefono']); ?>"><?php echo utf8_encode($result_row['telefono']); ?></a></td>
						  	<td style="text-align:center;"><?php echo "$ ".utf8_encode($result_row['saldo_monedero']); ?></td>
						  	<!--<td style="text-align:center;"><?php echo utf8_encode($result_row['usuario']); ?></td>-->
							<td width="30"><?php echo utf8_encode($result_row['email']); ?></td>
						  	<td style="text-align:center;"><?php echo utf8_encode($result_row['clave']); ?></td>
						  	<td style="text-align:center;"><?php echo utf8_encode($result_sucursal_row['sucursal']); ?></td>
						  	<td align="center">
								
								<button type="button" onClick="AbrirModalGeneral2('ModalPrincipal','900','560','catalogos/fc_cliente.php?id=<?php echo $result_row['idcliente'];?>');" title="EDITAR" class="btn btn-outline-info"><i class="mdi mdi-table-edit"></i></button>
							
								<button type="button" onClick="BorrarDatos('<?php echo $result_row['idcliente'];?>','idcliente','clientes','n','catalogos/vi_clientes.php','main')" title="BORRAR" class="btn btn-outline-danger"><i class="mdi mdi-delete-empty"></i></button>
								
							</td> 
						</tr>
					<?php 
						}while($result_row = $db->fetch_assoc($result_cliente));

					}else{
					}
					?>
				</tbody>
			</table>
		</div>
  	</div>
</div>