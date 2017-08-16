<?php
    session_start();
    if ( $_SESSION['estado'] == "logeado" ) { header(""); }
    else { header("Location: login.php?error=Por+favor+inicie+sesion"); }
?>

<!DOCTYPE html>
<html>
	<head>  		
		<meta charset="UTF-8">
		<meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
        <title>KIM up</title>  
        <link rel="stylesheet" href="General.css" type="text/css" media="screen"> 
        <link rel="stylesheet" href="Css.css" type="text/css" media="screen"> 
    </head> 
     
        
    <body> 
       	<section>
              <img src="img/logo.png" alt="">
              <p>
                  <?php $fecha_actual = date('F d/y',time()-21600); 
                        $hora = date('H:i a',time()-21600); 
                        $a=date("m");                       
                        echo "Usuario: ".$_SESSION['nombre']." <br> 
                        $fecha_actual <br> 
                        $hora <br><br>                         
                        <a id = 'Volver' href = 'index.php'> Volver atrás </a><br>
                        <a href = 'login-salir.php'> Cerrar sesión </a>"
                  ?>
              </p>
              
              <img id = "Horizontal" src="img/linea-h.png" alt="">
                
               
              <article id="mermas">
                    <form action="Mermas.php" method="POST" enctype="multipart/form-data">            
                      <fieldset id = "productos">
				          <legend>INGRESAR MERMA</legend><br><br><br>
                              <div id = "uno">   
                                  <div>Fecha: <input name="fecha" type="date" required="required" /></div>                       
                                  <div>Código de barra: 
                                      <select name="codigo">                                          
                                          <option value=""></option>                                           
                                            <?php                                                
                                                $con = include("conexion.inc");  
                                                mysql_select_db("kimup", $BDD);
                                                $sql = "SELECT * FROM productos ORDER BY codigo ASC";
                                                $res = mysql_query($sql);  
                  
                                                while ($row = mysql_fetch_array($res))
                                                {
                                                    echo "<option value='".$row[1]."'> ".$row[1]."</option>";
                                                }
                                            ?>
                                      </select><br><br>                                  
                                  </div>	     
                                  <div>Cantidad: <input type="number" name="cant" required="required" maxlength="50" /></div><br>                   
                              </div>	                                   
                              <div id = "dosm">                              
                                  <div><textarea type="text" rows="5" placeholder= " Motivo" name="motivo" required="required" maxlength="50"></textarea><br></div><br>                            
                                  <div><input type="submit" name="submit" value="ENVIAR" /><br><br><br><br><br></div>
                              </div>    
                              
                             <?php
                                $con = include("conexion.inc");  
                                mysql_select_db("kimup", $BDD);
                                if (isset($_POST['submit'])) 
                                {
                                    if (isset($_POST['fecha'])){$fecha = $_POST['fecha'];} else {$fecha = "";}
                                    if (isset($_POST['codigo'])){$codigo = $_POST['codigo'];} else {$codigo = "";}
                                    if (isset($_POST['cant'])){$cm= $_POST['cant'];} else {$cm = "";}
                                    if (isset($_POST['motivo'])){$motivo = $_POST['motivo'];} else {$motivo = "";}

                                    $sql = "INSERT INTO mermas(codigo, fecha, cantidad_mermas, motivo) 
                                    VALUES('$codigo', '$fecha', '$cm', '$motivo')";
                                    $result = mysql_query($sql); 
                                    
                                    $consulta = "UPDATE productos a SET a.cant_actual=a.cant_actual-'".$_POST['cant']."' where a.codigo='".$_POST['codigo']."'";
                                    $resp = mysql_query($consulta, $BDD);	
                                }  


                                $sql = "SELECT * FROM mermas";
                                $result = mysql_query($sql); 

                                echo "<table class='Inventario'>";
                                    echo "<tr id='invh'>
                                                <td>Código</td>
                                                <td>Fecha</td>
                                                <td>Cantidad</td>
                                                <td>Motivo</td>
                                          </tr><br>"; 

                                    while ($row = mysql_fetch_row($result))
                                    { 
                                        echo "<tr>
                                                    <td>$row[0]</td>
                                                    <td>$row[1]</td>
                                                    <td>$row[2]</td>
                                                    <td>$row[3]</td>
                                            </tr> \n";                                     
                                    } 	                  
                                echo "</table><br><br>";		
                            ?>
                                                                                                    
                     </fieldset>  
                     <footer>Copyright © 2017 KIM up - Escuela de Ingeniería en Informática</footer>	
				  </form>                                           
              </article>          
       	</section>      
       	 	
   </body>          
</html>
