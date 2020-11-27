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
	 
	 $sql_paqueterias = "SELECT * FROM preguntas";
	 $result_paqueterias = $db->consulta($sql_paqueterias);
	 $result_paqueterias_row = $db->fetch_assoc($result_paqueterias);
	 $result_paqueterias_row_num = $db->num_rows($result_paqueterias);

	$estatus = array('DESACTIVADO','ACTIVADO');

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
							"sZeroRecords": "Lo sentimos, no se han encontrado registros.",
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



		} );
		//} );
</script>


<div class="card mb-3">
	<div class="card-header">
		<h5 class="card-title" style="float: left; margin-top: 5px;">LISTA DE PREGUNTAS</h5>
		<button type="button" onClick="aparecermodulos('catalogos/fa_preguntas.php','main');" class="btn btn-info" style="float: right;">AGREGAR PREGUNTA</button>
		<div style="clear: both;"></div>
	</div>
  	<div class="card-body">
		<div class="table-responsive">
			<table id="zero_config" class="table table-bordered table-hover" cellpadding="0" cellspacing="0">
				<thead>
					<tr>
						<th>ID</th> 
						<th>PREGUNTA</th>
						
						<th>ESTATUS</th>
						<th>ACCI&Oacute;N</th>
					</tr>
				</thead>
				<tbody>
					<?php
					if($result_paqueterias_row_num == 0){
					}else{
            			do
						{
					?>
            
					<tr> 
   				  		<td style="text-align:center"><?php echo $result_paqueterias_row['idpreguntas']; ?></td>  
					  	<td><?php echo  $result_paqueterias_row['pregunta']; ?></td>
					  	
					  	
					  	
					  	<td><?php echo $estatus[$result_paqueterias_row['estatus']]; ?></td>
						<td align="center">
							
							<button type="button" onClick="aparecermodulos('catalogos/fa_preguntas.php?idpreguntas=<?php echo $result_paqueterias_row['idpreguntas']; ?>','main');" title="EDITAR" class="btn btn-outline-info"><i class="mdi mdi-table-edit"></i></button>
							
							<button type="button" onClick="BorrarDatos(<?php echo $result_paqueterias_row['idpreguntas']; ?>,'idpreguntas','preguntas','n','catalogos/vi_preguntas.php','main')" title="BORRAR" class="btn btn-outline-danger"><i class="mdi mdi-delete-empty"></i></button>							
						</td> 
					</tr>
					<?php 
					}while($result_paqueterias_row = $db->fetch_assoc($result_paqueterias));
					}
					?>
				</tbody>
			</table>
		</div>
  	</div>
</div>