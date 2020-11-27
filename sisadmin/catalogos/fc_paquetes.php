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

require_once("../clases/class.Paquetes.php");



$db = new MySQL();

$paq = new Paquetes ();



$paq->db = $db;



$paq->idpaquete_descuentos = $_GET['id'];



$result = $paq->obtenerDatosPaquete();











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



  

  

<article class="module width_full">

		<header>

		<h3 class="tabs_involved" >MODIFICAR  PAQUETE</h3>

        <ul class="tabs">

                <li><a href="#" onClick="aparecermodulos('catalogos/vi_paquetes.php','main');">Ver Paquetes</a></li>

			</ul>

            

		</header>

         <form  id="md_paquete" name="md_paquete">

            <div class="module_content">

                <fieldset>



                      

                  

                      

                  <label style="display:block; width:100%">Nombre:</label>

                    <input name="nombre" id="nombre" title="Nombre" value="<?php echo $result['nombre']; ?>" type="text" style="width:250px; display:block"   required> 

             

                   

                   <label style="display:block; width:100%">Descripcion:</label>

                    <textarea id="desc" name="desc" rows="4" style="width:200px;"><?php echo $result['descripcion']; ?></textarea>

                   <label style="display:block; width:100%">Cantidad Minima:</label>

                    <input name="minima" id="minima" value="<?php echo $result['cantidad_minima']; ?>" title="Cantidad Minima" type="text" style="width:250px; display:block" >

                    <label style="display:block; width:100%">Cantidad Maxima:</label>

                    <input name="maxima" id=" maxima" value="<?php echo $result['cantidad_maxima']; ?>" title="Cantidad Maxima" type="text" style="width:250px; display:block" >

                   

                    

                    

                   <label style="display:block; width:100%"> Descuento:</label>

                    <input name="descuento" id="descuento" value="<?php echo $result['descuento']; ?>" title="Descuento" type="text" style="width:350px; display:block">

                    <input type="hidden" id="id" name="id" value="<?php echo $result['idpaquete_descuentos'];?>" >

                   

                    <label style="display:block; width:100%"> Estatus:</label>

                    <select name="estatus" id="estatus" title="Estatus"  >

                    	<option <?php if ($result['estatus'] == 0){ echo " selected ";}?>  value="0">ACTIVO</option>

                        <option <?php if ($result['estatus'] == 1){ echo " selected ";}?> value="1">INACTIVO</option>

                    </select>

              </fieldset>

                 

                 

                 

           </div>

           <footer>

                <div class="submit_link">

                  <input type="button" value="Guardar Paquete" class="alt_btn" onclick="

                  var resp=MM_validateForm('nombre','','R','minima','','RisNum','maxima','','RisNum','descuento','','RisNum'); if(resp==1){ GuardarEspecial('md_paquete','catalogos/md_paquetes.php','catalogos/vi_paquetes.php','main') }">

                  

                </div>

            </footer>

           </form>

</article>

		

        