<?php
$resultados=array();
$dependencias=array();
//Función que elimína parámetros innecesarios como -v0, -v1....
function limpia($name)
{
  $ret=$name;
   //busco si se encuentra la cadena -v0
   if($pos=strpos($name, '-v') >  0)
   {
     $pos=$pos+2;
     $ret=substr($name, 0,-$pos);
   }
   return $ret;
}
if(isset($_REQUEST['comprobar']))
{
        $servicio=$_REQUEST["servicio"];
        if($servicio=="")
        {
                echo "No puede estar vacío";
        }else
        {
                $mysqli = new mysqli("localhost", "root", "toor", "bsis");
                if ($mysqli->connect_errno) {
                    echo "Fallo al conectar a MySQL: (" . $mysqli->connect_errno . ") " . $mysqli->connect_error;
                }
                //obtengo los desde
                if ($resultado = $mysqli->query("SELECT * FROM dependencias WHERE service_to LIKE'%".$servicio."%'")) {
                        while($row=mysqli_fetch_array($resultado))
                        {
                                array_push($dependencias, $row['service_from']);
                        }
                    $resultado->close();
                }else
                {
                 echo "error ".$mysqli->error;
                }
                //obtengo los dependientes con
                if ($resultado = $mysqli->query("SELECT * FROM dependencias WHERE service_FROM LIKE'%".$servicio."%'")) {
                        while($row=mysqli_fetch_array($resultado))
                        {
                                array_push($dependencias, $row['service_to']);
                        }
                    $resultado->close();
                }else
                {
                 echo "error ".$mysqli->error;
                }
                //si hay alguna dependencia, compruebo sus versiones no coincidentes
                if(sizeof($dependencias) > 0 )
                {
                  foreach ($dependencias as $dependencia) {
                    if ($resultado = $mysqli->query("SELECT * FROM alineamiento WHERE display_name LIKE '%".limpia($dependencia)."%'")) {
                            while($row=mysqli_fetch_array($resultado))
                            {
                                    array_push($resultados, $row);
                            }
                        $resultado->close();
                    }
                  }
                }

        }


}

?>
<html>
<head>
        <title>Admin dependencias BSIS</title>
<style>
table
{
        border-collapse:collapse;

}
table td,th
{
        border:solid 1px black;
        padding:5px;
}
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
        <h1>Consulta de dependencias BSIS</h1>
        <form method="POST">
                Introduce servicio: <input type="text" id="servicio" name="servicio" />
                <button type="submit" id="comprobar" name="comprobar">Comprobar</button>
        </form>
        <div id="resultados">
                <?php
                        if(sizeof($resultados)>0)
                        {
                                echo '<table><tr><th>Technology</th><th>Line</th><th>Display name</th><th>Version UAT</th><th>Version PRO</th><th>Same Version</th></tr>';
                                foreach ($resultados as $linea) {
                                        echo '<tr ';
					if($linea['same_version'])
					{
					  echo 'style="background:#b0f884"';
					}else
					{
					 echo 'style="background:#f58947"';
					}
					echo '><td>'.$linea['technology'].'</td><td>'.$linea['line'].'</td><td>'.$linea['display_name'].'</td><td>'.$linea['uat_version'].'</td><td>'.$linea['pro_version'].'</td><td>';
                                        if($linea['same_version'])
                                        {
                                                echo 'TRUE';
                                        }else
                                        {
                                                echo 'FALSE';
                                        }
                                        echo '</td></tr>';
                                }
                                echo '</table>';
                        }
                ?>
        </div>
<br/><br/>
       <a class="btn" href="index.php">Inicio</a>
</body>
</html>

