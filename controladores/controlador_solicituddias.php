<?php	
	session_start();
	
	if (isset($_REQUEST["DNI"])){
		$solicitud["DNI"] = $_REQUEST["DNI"];
		$solicitud["DIASAPEDIR"] = $_REQUEST["DIASAPEDIR"];
		$solicitud["MOTIVO"] = $_REQUEST["MOTIVO"];
		
		
		$_SESSION["solicitud"] = $solicitud;
			
		if (isset($_REQUEST["PEDIR"])) Header("Location: ../validaciones/validacion_solicituddias.php"); 
		
	}
	else 
		Header("Location: ../muestra/peticiondias.php");

?>
