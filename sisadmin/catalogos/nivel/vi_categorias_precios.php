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
	 require_once("../../clases/class.Categoria_Descuento.php");
	 
	 $db = new MySQL();
	 $cd = new categoria_descuento();
	 
	 $cd->db = $db;
	 
	 $result_categorias = $cd->todasCategoriasPrecio();
	 $result_categorias_row = $db->fetch_assoc($result_categorias);
	 $result_categorias_num = $db->num_rows($result_categorias);
	 
	 $result_niveles = $cd->todosNiveles();
	 $result_niveles_row = $db->fetch_assoc($result_niveles);
	 $result_niveles_num = $db->num_rows($result_niveles);
	 
	 $result_cpn = $cd->todosCatPreNiveles();
	 $result_cpn_row = $db->fetch_assoc($result_cpn);
	 $result_cpn_num = $db->num_rows($result_cpn);
 
 
 	$estatus = array('Inactivo','Activo');



 ?>
<script type="text/javascript" charset="utf-8">

//$(document).ready(function() {

var oTable = $('#d_modulos').dataTable( {		

	  "oLanguage": {
					"sLengthMenu": "Mostrar _MENU_ Registros",
					"sZeroRecords": "Nada Encontrado - Disculpa",
					"sInfo": "Mostrar _START_ a _END_ de _TOTAL_ Registros",
					"sInfoEmpty": "desde 0 a 0 de 0",
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
} );


var oTable2 = $('#d_niveles').dataTable( {		

	  "oLanguage": {
					"sLengthMenu": "Mostrar _MENU_ Registros",
					"sZeroRecords": "Nada Encontrado - Disculpa",
					"sInfo": "Mostrar _START_ a _END_ de _TOTAL_ Registros",
					"sInfoEmpty": "desde 0 a 0 de 0",
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
} );



var oTable3 = $('#d_desc').dataTable( {		

	  "oLanguage": {
					"sLengthMenu": "Mostrar _MENU_ Registros por p&aacute;gina",
					"sZeroRecords": "Nada Encontrado - Disculpa",
					"sInfo": "Mostrar _START_ a _END_ de _TOTAL_ Registros",
					"sInfoEmpty": "desde 0 a 0 de 0",
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
} );


//});

</script>
    

<div class="card mb-3">
	<div class="card-header">
		<h4 class="m-0 font-weight-bold text-primary" style="float: left; margin-top: 5px;">DESCUENTO POR CATEGOR&Iacute;A</h4>
  	</div>
</div>

<div class="card"  style="background: transparent!important; padding: 0">
	<div class="card-body" style="padding: 0">		
		<div class="row">
			<div class="col-md-6">
				<div class="card mb-3">
					<div class="card-header">
						<h5 class="m-0 font-weight-bold text-primary" style="float: left; margin-top: 5px;">LISTA DE CATEGOR&Iacute;AS</h5>
						<button type="button" onClick="AbrirModalGeneral2('ModalPrincipal','900','560','catalogos/nivel/fa_categorias_precios.php');" class="btn btn-outline-primary" style="float: right;" >AGREGAR CATEGOR&Iacute;A</button>
						<div style="clear: both;"></div>
					</div>
					<div class="card-body">
              <div class="table-responsive">
                <table class="table table-bordered" id="d_modulos" width="100%" cellspacing="0" style="text-align: center; ">
				<thead class="mb-4 py-3 px-3 py-5 bg-gradient-primary text-white" >
					<tr>
										<th>ID CATEGOR&Iacute;A</th> 
										<th>NOMBRE</th>
										<th>ESTATUS</th>
									</tr>
								</thead>

								<tbody>
								<?php
								if($result_categorias_num != 0){
									do
									{ 
								?>
										<tr onDblClick="AbrirModalGeneral2('ModalPrincipal','900','560','catalogos/fc_categorias_precios.php?id=<?php echo $result_categorias_row['idcategoria_precio']; ?>');" style="cursor:pointer;"> 
											<td style="text-align:center"><?php echo $result_categorias_row['idcategoria_precio']; ?></td> 
											<td><?php echo $result_categorias_row['nombre']; ?></td>
											<td><?php echo $estatus[$result_categorias_row['estatus']]; ?></td>
										</tr>
								<?php
									}while($result_categorias_row = $db->fetch_assoc($result_categorias));
								}
								?>
								</tbody>
							</table>
						</div>
					</div>
				</div>
			</div>
			
			<div class="col-md-6">
				<div class="card mb-3">
					<div class="card-header">
						<h5 class="m-0 font-weight-bold text-primary" style="float: left; margin-top: 5px;">LISTA DE NIVELES</h5>
						<button type="button" onClick="AbrirModalGeneral2('ModalPrincipal','900','560','catalogos/fa_niveles.php');" class="btn btn-outline-primary" style="float: right;">AGREGAR NIVEL</button>
						<div style="clear: both;"></div>
					</div>
					<div class="card-body">
              <div class="table-responsive">
                <table class="table table-bordered" id="d_niveles" width="100%" cellspacing="0" style="text-align: center; ">
				<thead class="mb-4 py-3 px-3 py-5 bg-gradient-primary text-white" >
					<tr>
										<th>ID NIVELES</th> 
										<th>NOMBRE</th>
										<th>ESTATUS</th>
									</tr>
								</thead>

								<tbody>
									<?php
									if($result_niveles_num != 0){
										do
										{ 
									?>
										<tr onDblClick="AbrirModalGeneral2('ModalPrincipal','900','560','catalogos/fc_niveles.php?id=<?php echo $result_niveles_row['idniveles']; ?>');" style="cursor:pointer;"> 
											<td style="text-align:center"><?php echo $result_niveles_row['idniveles']; ?></td> 
											<td><?php echo utf8_encode($result_niveles_row['nombre']); ?></td>
											<td><?php echo $estatus[$result_niveles_row['estatus']]; ?></td>
										</tr>
									<?php
										}while($result_niveles_row = $db->fetch_assoc($result_niveles));
									}
									?>
								</tbody>
							</table>
						</div>
					</div>
				</div>                
			</div>
			
			
			<div class="col-md-12">
				<div class="card mb-3">
					<div class="card-header">
						<h5 class="m-0 font-weight-bold text-primary" style="float: left; margin-top: 5px;">LISTA DE DESCUENTOS DE CATEGOR&Iacute;A POR NIVELES</h5>
						<button type="button" onClick="AbrirModalGeneral2('ModalPrincipal','900','560','catalogos/fa_cat_pre_niveles.php');" class="btn btn-outline-primary" style="float: right;">AGREGAR DESCUENTO</button>
						<div style="clear: both;"></div>
					</div>
					<div class="card-body">
              <div class="table-responsive">
                <table class="table table-bordered" id="d_desc" width="100%" cellspacing="0" style="text-align: center; ">
				<thead class="mb-4 py-3 px-3 py-5 bg-gradient-primary text-white" >
					<tr>
										<th>CATEGOR&Iacute;A</th> 
										<th>NIVEL</th>
										<th>DESCUENTO</th>
									</tr>
								</thead>

								<tbody>
									<?php
										if($result_cpn_num != 0){ 
											do
											{
										?>
										<tr onDblClick="AbrirModalGeneral2('ModalPrincipal','900','560','catalogos/fc_cat_pre_niveles.php?idcategoria_precio=<?php echo $result_cpn_row['idcategoria_precio']; ?>&idniveles=<?php echo $result_cpn_row['idniveles']; ?>');" style="cursor:pointer;"> 
										  <td style="text-align:center"><?php echo utf8_encode($result_cpn_row['nombreCat']); ?></td> 
										  <td><?php echo utf8_encode($result_cpn_row['nombreNivel']); ?></td>
										  <td><?php echo $result_cpn_row['descuento']."%"; ?></td>
										</tr>
										<?php
											}while($result_cpn_row = $db->fetch_assoc($result_cpn));
										}
										?>
								</tbody>
							</table>
						</div>
					</div>
				</div>
			</div>
			
		</div>
	</div>
</div>



