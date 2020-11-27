<?php
    require_once("../clases/class.Mensajes.php");
	require_once("../clases/conexcion.php");

	$db = new MySQL();	
		
	try
	{
	$msg = new mensajes();
	
	
	$msg->db = $db;
	$msg->id = $_POST['id'];	
	$msg->delNumeros();	
	
	$msg->verClientes();
	} catch(Exception $e) 
	    {
		  $db->rollback();	
		  $v = explode ('|',$e);
		  $n = explode ("'",$v[1]);
		  echo "Se hizo rollback ". $db->m_error($n[0]);   
		 }
	
?>