<?php

	session_start();

    require_once("gestionas/gestionBD.php");
    require_once("gestionas/gestionarMaquina.php");
    require_once("consultaPaginada.php");
	unset($_SESSION["paginacion"]);
	
	if (isset($_SESSION["paginacion"])) $paginacion = $_SESSION["paginacion"];
	$pagina_seleccionada = isset($_GET["PAG_NUM"])? (int)$_GET["PAG_NUM"]: (isset($paginacion)? (int)$paginacion["PAG_NUM"]: 1);

	$pag_tam = isset($_GET["PAG_TAM"])? (int)$_GET["PAG_TAM"]: (isset($paginacion)? (int)$paginacion["PAG_TAM"]: 5);

	if ($pagina_seleccionada < 1) $pagina_seleccionada = 1;
	if ($pag_tam < 1) $pag_tam = 5;

	unset($_SESSION["paginacion"]);

	$conexion = crearConexionBD();

	$query = "SELECT nombre,apellidos,cargo FROM EMPLEADO WHERE EMPLEADO.OID_MAQ<>'1'";

	
	$total_registros = total_consulta($conexion,$query);
	$total_paginas = (int) ($total_registros / $pag_tam);

	if ($total_registros % $pag_tam > 0) $total_paginas++;
	if ($pagina_seleccionada > $total_paginas) $pagina_seleccionada = $total_paginas;

	$paginacion["PAG_NUM"] = $pagina_seleccionada;
	$paginacion["PAG_TAM"] = $pag_tam;
	$_SESSION["paginacion"] = $paginacion;
	
	$filas = consulta_paginada($conexion, $query, $pagina_seleccionada, $pag_tam);
	
    cerrarConexionBD($conexion);
?>

<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
  <link rel="stylesheet" type="text/css" href="css/muestraTabla.css" />
  <link rel="stylesheet" type="text/css" href="css/muestraMaquinas.css" />
   <link rel="stylesheet" type="text/css" href="css/popup3.css" />
  <script type="text/javascript" src="js/filtro.js"></script>
  <title>Lista de máquinas</title>
</head>

<body>


<main>

	<div class="titulotabla">
	 	<div><h2 class="titulo">Listado de las máquinas</h2></div>
	 </div>
	<div class="selectpag">
	
	
	<form method="get" action="muestraMaquinas.php">

			<input id="PAG_NUM" name="PAG_NUM" type="hidden" value="<?php echo $pagina_seleccionada?>"/>

			Mostrando

			<input id="PAG_TAM" name="PAG_TAM" type="number"

				min="1" max="<?php echo $total_registros;?>"

				value="<?php echo $pag_tam?>" autofocus="autofocus" />

			entradas de <?php echo $total_registros?>

			<input type="submit" value="Cambiar">

		</form>
		
		</div>
		
		<div class ="tabla">
	 <table class="tabla" id="tablaMaquina">
	 	
		<tr>
    		<th>Nombre</th>
    		<th>Apellidos</th>
    		<th>Cargo</th>
  		</tr>

	<?php
		$contador=0;
		$contador2=0;
		foreach($filas as $fila) {

	?>

		<form method="post" action="controladores/controlador_maquinas.php">

			<div class="fila_maquina">

				<div class="datos_maquina">

					<input id="OID_MAQ" name="OID_MAQ" type="hidden" value="<?php echo $fila["OID_MAQ"]; ?>"/>
					<input id="NOMBRE" name="NOMBRE" type="hidden" value="<?php echo $fila["NOMBRE"]; ?>"/>

						<tr class="fila">
							<td class="nombre" align="center"><p onclick="window.location='#popup<?php echo $contador; ?>';"><?php echo $fila['NOMBRE'] ?></p></td>
							
							
							
							<td align="center"><?php echo $fila['APELLIDOS'] ?></td>
							<td align="center"><?php echo $fila['CARGO'] ?></td>
							
							
							
							<form action="controladores/controlador_maquinas.php">
								
								<td class ="boton">
									<button id="add" name="add" type="submit" class="vistacliente">
									<img src="img/addButton.png" class="borrar_fila" alt="Papelera Borrar" height="40" width="40">
									</button>
								</td>
								
								
								
								
								
								
								
								<div id="popup<?php echo $fila["NOMBRE"]; echo "Remove"; ?>" class="overlay" align="left">
									<div class="popup">
										<a class="close" href="#">X</a>
										<p align="center">¿Seguro que quieres borrar la máquina: <?php echo $fila['NOMBRE'];?>?</p>
									</br>
										<button id="borrar" name="borrar" type="submit" class="bPop">Borrar</button>
									</div>
								</div>
								
								
								
								
								
								
								
								
								
								<!-- <div id="popup<?php echo $fila["NOMBRE"]; echo "Add"; ?>" class="overlay" align="left">
									<div class="popup">
										<a class="close" href="#">X</a>
										<
										<?php $conexion = crearConexionBD(); 
											  $empleadosNM = getEmpleadosNoEnMaquina($conexion,$fila['OID_MAQ']);
											  foreach($empleadosNM as $empleado){
											  	
											  
										
										?>
										<p align="center"><?php echo $empleado['NOMBRE']; ?></p>
										<?php } ?>
										<
									</div>
								</div> -->
								
								
								
								
								
								
								
								
								
								
								
								
								<div id="popup<?php echo $contador; ?>" class="overlay" align="left">
									<div class="popup">
										<a class="close" href="#">X</a>
										<div class="dJefe" align="center">

										<label class="jefMaq"><?php 
												$conexion=crearConexionBD();
	
												$jefe = getJefeMaquina2($conexion,$fila['OID_MAQ']);
												cerrarConexionBD($conexion);

												echo $jefe['NOMBRE']; echo " "; echo $jefe['APELLIDOS']; echo " "; echo "</br>";
											
										
										?>
										</label>
										</div>
										<div class="dPeones" align="center">

										<label class="peones"><?php 
												$conexion=crearConexionBD();
	
												$peones = getEmpleadosMaquina($conexion,$fila['OID_MAQ']);
												cerrarConexionBD($conexion);


												foreach($peones as $peon){
													echo $peon['NOMBRE']; echo " "; echo $peon['APELLIDOS']; echo " "; echo "</br>";
												}
											
										
										?>
										</label>
										</div>
										
									</br>
									</div>
								</div>
								
								
							</form>
						</tr>
						
				<?php $contador++;$contador2++; } ?>

				</div>
			</div>
		</form>
	
	 </table>
	</div>
	
	<div class="paginas">
		<nav>
			<div id="enlaces">
			<?php
			
				if($total_paginas <=6){
					 for( $pagina = 1; $pagina <= $total_paginas; $pagina++ )
						if ( $pagina == $pagina_seleccionada) { 	?>
							<span class="current"><?php echo $pagina; ?></span>

			<?php }	else { ?>

						<a href="muestraMaquinas.php?PAG_NUM=<?php echo $pagina; ?>&PAG_TAM=<?php echo $pag_tam; ?>"><?php echo $pagina; ?></a>

			<?php }
			 }
				
				else if($pagina_seleccionada >= $total_paginas-3) {
					 for( $pagina = $pagina_seleccionada-(6-($total_paginas-$pagina_seleccionada)); $pagina <= $total_paginas; $pagina++ )
						if ( $pagina == $pagina_seleccionada) { 	?>

						<span class="current"><?php echo $pagina; ?></span>

			<?php }	else { ?>

						<a href="muestraMaquinas.php?PAG_NUM=<?php echo $pagina; ?>&PAG_TAM=<?php echo $pag_tam; ?>"><?php echo $pagina; ?></a>

			<?php }
			 }
				else if($pagina_seleccionada <= 4) { 
					for( $pagina = 1; $pagina <= $pagina_seleccionada+(7-$pagina_seleccionada); $pagina++ )
					if ( $pagina == $pagina_seleccionada) { 	?>

						<span class="current"><?php echo $pagina; ?></span>

			<?php }	else { ?>

						<a href="muestraMaquinas.php?PAG_NUM=<?php echo $pagina; ?>&PAG_TAM=<?php echo $pag_tam; ?>"><?php echo $pagina; ?></a>

			<?php } 
				}
				else {
					for( $pagina = $pagina_seleccionada-3; $pagina <= $pagina_seleccionada+3; $pagina++ )
				if ( $pagina == $pagina_seleccionada) { 	?>

						<span class="current"><?php echo $pagina; ?></span>

			<?php }	else { ?>

						<a href="muestraMaquinas.php?PAG_NUM=<?php echo $pagina; ?>&PAG_TAM=<?php echo $pag_tam; ?>"><?php echo $pagina; ?></a>

			<?php } 
				} ?>
			

		</div>
		</nav>
		</div>
	
</main>
</body>
</html>