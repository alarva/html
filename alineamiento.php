<?php
require_once(dirname(__FILE__).'/PHPExcel/IOFactory.php');
//conexión a bbdd
$mysqli = new mysqli("localhost", "root", "toor", "bsis");
if ($mysqli->connect_errno) {
    echo "Fallo al conectar a MySQL: (" . $mysqli->connect_errno . ") " . $mysqli->connect_error;
}
$inputFileName = 'alineamiento.xlsx';
$objPHPExcel = PHPExcel_IOFactory::load($inputFileName);
$lines = $objPHPExcel->getSheet(1)->toArray(null,true,true,true);
$mysqli->query("TRUNCATE TABLE alineamiento");

$q="INSERT INTO alineamiento(technology,line,display_name,uat_version,pro_version,same_version) VALUES ";
for($i=2;$i<sizeof($lines);$i++)
{
	if($lines[$i]['A']!='')
	{
		$q.="('".$lines[$i]['A']."','".$lines[$i]['B']."','".$lines[$i]['C']."','".$lines[$i]['D']."','".$lines[$i]['E']."',";
		if($lines[$i]['F']=="FALSE")
		{
			$q.="'0'),";
		}else
		{
			$q.="'1'),";
		}
	}

}
//elimino la última coma
$q=substr($q,0,-1);
if ($resultado = $mysqli->query($q)) {
    echo "insertado correctamente";
    $mysqli->close();
}else
{
 echo "error ".$mysqli->error;
}

?>
<html>
<head>
        <title>Alineamiento</title>
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

</style>
</head>
<body>
<p>
	<a class="btn" href="index.php">Inicio</a>
</p>	
</body>
</html>
