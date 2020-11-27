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
require_once("../clases/class.Fechas.php");


$db = new MySQL();
$fe = new Fechas();

$sqlgastos = "SELECT * FROM gastos_categorias";
$result_gastos= $db->consulta($sqlgastos);
$result_gastos_row = $db->fetch_assoc($result_gastos);
$result_gastos_row_num = $db->num_rows($result_gastos);

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


$t_gasto = array('FIJO','VIATICOS');


?>

<script type="text/javascript" charset="utf-8">

//$(document).ready(function() {

var oTable = $('#zero_config').dataTable( {		

	  "oLanguage": {
					"sLengthMenu": "Mostrar _MENU_ Registros por p&aacute;gina",
					"sZeroRecords": "NO EXISTEN CONCEPTOS DE GASTOS EN LA BASE DE DATOS",
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
	   "sScrollX": "100%",
	   "sScrollXInner": "100%",
	   "bScrollCollapse": true



});
//});

</script>

<div class="card">
	<div class="card-body">
		
		<div id="mensajes"></div>
		
		<h5 class="card-title">LISTA DE CONCEPTOS DE GASTOS</h5>
		
		<div style="padding: 20px;">
			<button type="button" onClick="aparecermodulos('catalogos/fa_gasto.php','main');" class="btn btn-primary" style="float: right;">Nueva Concepto de Gasto</button>
			<div style="clear: both;"></div>
		</div>
		
		
		<div class="table-responsive">
			<table id="zero_config" class="table table-striped table-bordered">
				<thead>
					<tr>
						<th style="text-align:center">ID GASTO</th> 
				   		<th style="text-align:center">GASTO</th>
				   		<th style="text-align:center">DESCRIPCION</th> 
   				   		<th style="text-align:center">TIPO</th>                   
                   		<th style="text-align:center">ACCIONES</th>
					</tr>
				</thead>
				<tbody>
<?php
					if($result_gastos_row_num != 0)
			 		{
		           		do
			         	{ 
?>
           
			   	<tr>
			   		<td align="center"><?PHP echo $result_gastos_row['idgastos_categorias']; ?></td> 
			     	<td align="center"><?php echo $result_gastos_row['categoria']; ?></td>
			     	<td align="center"><?php echo  $result_gastos_row['descripcion']; ?></td> 
			     	<td align="center"><?php echo  $t_gasto[$result_gastos_row['tipo']]; ?></td> 
   			
   			     	<td align="center">						
						<a href="#" onClick="aparecermodulos('catalogos/fc_gasto.php?id=<?php echo $result_gastos_row['idgastos_categorias'];?>','main')" title="EDITAR"><i class="mdi mdi-table-edit"></i></a>
						<a href="#" onClick="BorrarDatos('<?php echo $result_gastos_row['idgastos_categorias'];?>','idgastos_categorias','gastos_categorias','n','catalogos/vi_gastos.php','main')" title="BORRAR"><i class="mdi mdi-delete-empty"></i></a>
					</td> 
			   </tr>
<?php
						}while($result_gastos_row = $db->fetch_assoc($result_gastos));
			 		}else{
			  		}
?>
				</tbody>
			</table>
		</div>
	</div>
</div>		