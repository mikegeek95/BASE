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
 require_once("../../clases/class.Funciones.php");
	 
	 $db = new MySQL();
$f = new Funciones();

$estatus=$f->guardar_cadena_utf8($_POST['v_estatus']);
$sexo=$f->guardar_cadena_utf8($_POST['v_sexo']);
$nombre=$f->guardar_cadena_utf8($_POST['v_nombre']);
$paterno=$f->guardar_cadena_utf8($_POST['v_paterno']);
$materno=$f->guardar_cadena_utf8($_POST['v_materno']);
$email=$f->guardar_cadena_utf8($_POST['v_email']);
//$idclientes=$f->guardar_cadena_utf8($_POST['idcliente']);
$idclientes="";
	 
	 $sql_cliente = "SELECT * FROM clientes where 1=1 ";
	 $sql_cliente .= ($estatus != '') ? " AND estatus = '$estatus'":" ";
	 $sql_cliente .= ($sexo != '') ? " AND sexo = '$sexo'":" ";
	 $sql_cliente .= ($nombre != '') ? " AND nombre like '%$nombre%'":" ";
	 $sql_cliente .= ($paterno != '') ? " AND paterno like '%$paterno%'":" ";
	 $sql_cliente .= ($materno != '') ? " AND materno like '%$materno%'":" ";
	 $sql_cliente .= ($email != '') ? " AND email like '%$email%'":" ";
 	 $sql_cliente .= ($idclientes != '') ? " AND idcliente = '$idclientes'":" ";



	 $result_cliente = $db->consulta($sql_cliente);
	 $result_row = $db->fetch_assoc($result_cliente);
	 $result_row_num = $db->num_rows($result_cliente);

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
						  	<td><?php echo $f->imprimir_cadena_utf8( $result_row['nombre']." ".$result_row['paterno']." ".$result_row['materno']); ?></td>
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