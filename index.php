<?php
?>
<html>
<head>
        <title>Admin dependencias BSIS</title>
<style>
.btn {
  background: #3498db;
  background-image: -webkit-linear-gradient(top, #3498db, #2980b9);
  background-image: -moz-linear-gradient(top, #3498db, #2980b9);
  background-image: -ms-linear-gradient(top, #3498db, #2980b9);
  background-image: -o-linear-gradient(top, #3498db, #2980b9);
  background-image: linear-gradient(to bottom, #3498db, #2980b9);
  -webkit-border-radius: 28;
  -moz-border-radius: 28;
  border-radius: 28px;
  font-family: Arial;
  color: #ffffff;
  font-size: 20px;
  padding: 10px 20px 10px 20px;
  text-decoration: none;
}

.btn:hover {
  background: #3cb0fd;
  background-image: -webkit-linear-gradient(top, #3cb0fd, #3498db);
  background-image: -moz-linear-gradient(top, #3cb0fd, #3498db);
  background-image: -ms-linear-gradient(top, #3cb0fd, #3498db);
  background-image: -o-linear-gradient(top, #3cb0fd, #3498db);
  background-image: linear-gradient(to bottom, #3cb0fd, #3498db);
  text-decoration: none;
}
#container
{
  width:100%;

}
#container h1 
{
 margin-top:30px;
 text-align:center;
}
#botonera
{
 padding-left:30%;
 padding-top:50px;
 

</style>
</head>
<body>
<div id="container">
	<h1>Panel de administraci&oacute;n de dependencias BSIS</h1>
	<div id="botonera">
	 <a class="btn" href="consulta.php">Consulta</a>
     	 <a class="btn" href="alineamiento.php">Subir alineamiento</a>
	 <a class="btn" href="governance.php">Subir governance</a>
	</div>
</div>
</body>
</html>
