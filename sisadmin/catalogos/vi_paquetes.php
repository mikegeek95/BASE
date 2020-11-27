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
	 
	 $sql_paquetes = "SELECT * FROM paquete_descuentos";
	 $result_paquetes = $db->consulta($sql_paquetes);
	 $result_paquetes_row = $db->fetch_assoc($result_paquetes);
	 $result_paquetes_row_num = $db->num_rows($result_paquetes);
	 
	 $estatus = array ("ACTIVO","INACTIVO");
 
 
 
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

<script type="text/javascript" charset="utf-8">

//$(document).ready(function() {

var oTable = $('#zero_config').dataTable({		

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
	   "sScrollX": "100%",
	   "sScrollXInner": "100%",
	   "bScrollCollapse": true



});
	
//});

</script>


<div class="card">
	<div class="card-body">
		<h5 class="card-title">PAQUETES</h5>
		
		<div style="padding: 20px;">
			<button type="button" onClick="aparecermodulos('catalogos/fa_paquetes.php','main');" class="btn btn-primary" style="float: right;">Agregar Paquete</button>
			<div style="clear: both;"></div>
		</div>
		
		
		<div class="table-responsive">
			<table id="zero_config" class="table table-striped table-bordered">
				<thead>
					<tr>
						<th>ID PAQUETE</th> 
						<th>NOMBRE</th>
						<th>MINIMO</th>
						<th>MAXIMO</th>
						<th>DESCUENTO</th>
						<th>ESTATUS</th>
						<th>ACCI&Oacute;N</th>
					</tr>
				</thead>
				<tbody>
<?php
					if($result_paquetes_row_num  != 0)
					{
            			do
						{
?>
            
					<tr> 
   				  		<td align="center" style="text-align:center"><?php echo $result_paquetes_row['idpaquete_descuentos']; ?></td> 
   				  		<td align="center"><?php echo $result_paquetes_row['nombre']; ?></td>
                  		<td align="center"><?php echo $result_paquetes_row['cantidad_minima'];; ?></td>
                  		<td align="center"><?php echo $result_paquetes_row['cantidad_maxima']; ?></td>
                  		<td align="center"><?php echo "%".$result_paquetes_row['descuento']; ?></td>
                  		<td align="center"><?php echo $estatus[$result_paquetes_row['estatus']]; ?></td>
                  
                  		<td align="center">
                    		<input type="image" src="images/icn_edit.png" title="EDITAR" onclick="aparecermodulos('catalogos/fc_paquetes.php?id=<?php echo $result_paquetes_row['idpaquete_descuentos'];?>','main')">
                   			<input type="image" src="images/icn_trash.png" title="BORRAR" onclick="BorrarDatos('<?php echo $result_paquetes_row['idpaquete_descuentos'];?>','idpaquete_descuentos','paquete_descuentos','n','catalogos/vi_paquetes.php','main')">
						</td> 
					</tr>
<?php 
						}while($result_paquetes_row = $db->fetch_assoc($result_paquetes));	
					}else{				
					}
?>
				</tbody>
			</table>
		</div>
	</div>
</div>