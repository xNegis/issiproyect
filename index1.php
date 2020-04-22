<?php session_start(); ?>
<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="utf-8">
  <link rel="stylesheet" type="text/css" href="css/dropdown.css" />
  <title>Gestión de biblioteca: Login</title>
</head>

<body>
	<script>
		function despligue() {
  document.getElementById("myDropdown").classList.toggle("show");
}

window.onclick = function(event) {
  if (!event.target.matches('.dropbtn')) {
    var dropdowns = document.getElementsByClassName("dropdown-content");
    var i;
    for (i = 0; i < dropdowns.length; i++) {
      var openDropdown = dropdowns[i];
      if (openDropdown.classList.contains('show')) {
        openDropdown.classList.remove('show');
      }
    }
  }
	}
	</script>
<div class="dropdown">
	<?php if($_SESSION['cargo']=="GERENTEVENTAS"){
		
	?>
  <button onclick="despligue()" class="dropbtn">Dropdown</button>
  <div id="myDropdown" class="dropdown-content">
    <a href="vistas/gerenteVentas/pruebaGV.php">Prueba</a>
    <a href="#">Link 2</a>
    <a href="#">Link 3</a>
  </div>
  <?php }else{ ?>
  	  <button onclick="despligue()" class="dropbtn">Dropdown</button>
  <div id="myDropdown" class="dropdown-content">
    <a href="#">xd</a>
    <a href="#">xd</a>
    <a href="#">xd</a>
  </div>
  <?php  }  ?> 
</div>
<p>Hola <?php echo $_SESSION['nombre']?></p>
<form action="logout.php" method="post">
    <input type="submit" value="Logout" name="Submit" id="logout" />
</form>
</body>
</html>

