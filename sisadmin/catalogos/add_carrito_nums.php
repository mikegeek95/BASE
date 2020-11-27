<?php
  require_once("../clases/class.Sesion.php");
//creamos nuestra sesion.
$se = new Sesion();


if(!isset($_SESSION['se_SAS']))
{
	header("Location: ../login.php");
	exit;
}

   require_once("../clases/conexcion.php");
   require_once("../clases/class.Mensajes.php");
      
   try
   {
	  $db = new MySQL();
	  $msg = new mensajes();
	   
	  //Recibimos parametros
	  $id = trim($_POST['id']);
	  $numero = trim($_POST['numero']);
	  	  
	 //Llenamos la lista de numeros	
	 $msg->addNumeros($id,$numero);

	  
	 //Visualizamos la lista de numeros
	 $msg->verClientes(); 
	  
  }catch(Exception $e)
        {
		  $v = explode ('|',$e);
		  $n = explode ("'",$v[1]);
		  echo $db->m_error($n[0]);
        }


?>