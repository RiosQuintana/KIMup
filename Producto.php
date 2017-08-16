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
                        echo "Usuario: ".$_SESSION['nombre']." <br> 
                        $fecha_actual <br> 
                        $hora <br><br>                         
                        <a id = 'Volver' href = 'index.php'> Volver atrás </a><br>
                        <a href = 'login-salir.php'> Cerrar sesión </a>"
                  ?>
              </p>
              
              <img id = "Horizontal" src="img/linea-h.png" alt="">
                
               
              <article>
                    <form action="Producto.php" method="POST" enctype="multipart/form-data">            
                      <fieldset id = "productos">
				          <legend>INGRESAR PRODUCTO</legend><br><br><br>
                              <div id = "uno">    
                                  <div>Fecha: <input name="fecha" type="date" required="required" /></div>	                               
                                  <div>Código de barras: <input type="number" name="codigo" required="required" maxlength="100" /></div>	
                                  <div>Descripción: <input type="text" name="desc" required="required" maxlength="50" /></div>
                                  <div>Proveedor: <input type="text" name="prov" required="required" maxlength="50" /></div>
                                  <div>Costo: <input type="number" name="pcompra" required="required" maxlength="10" /></div>		
                              </div>	     
                              
                              <div id = "dos">                              
                                  <div>Cantidad: <input type="number" name="cant" required="required" maxlength="10" /></div>
                                  <div>Cant. mínima: <input type="number" name="min" required="required" maxlength="10" /></div>	
                                  <div>Cant. actual: <input type="number" name="cant_a" maxlength="10" /></div>	
                                  <div>Precio venta: <input type="number" name="pventa" required="required" maxlength="10" /></div>                        
                                  <div>Departamento: <input type="text" name="depto" required="required" maxlength="50" /></div><br><br>	
                                  <div><input type="submit" name="submit" value="ENVIAR"/><br></div><br> 
                              </div>                                       
                     </fieldset>  
                     
                     <?php
                            $con = include("conexion.inc");  
                            mysql_select_db("kimup", $BDD);
                            if (isset($_POST['submit'])) {
                            if (isset($_POST['fecha'])){$fecha = $_POST['fecha'];} else {$fecha = "";}
                            if (isset($_POST['codigo'])){$codigo = $_POST['codigo'];} else {$codigo = "";}
                            if (isset($_POST['desc'])){$desc = $_POST['desc'];} else {$desc = "";}
                            if (isset($_POST['prov'])){$prov = $_POST['prov'];} else {$prov = "";}
                            if (isset($_POST['cant'])){$cant = $_POST['cant'];} else {$cant = "";}
                            if (isset($_POST['pcompra'])){$pcompra = $_POST['pcompra'];} else {$pcompra = "";}
                            if (isset($_POST['pventa'])){$pventa = $_POST['pventa'];} else {$pventa = "";}
                            if (isset($_POST['depto'])){$depto = $_POST['depto'];} else {$depto = "";}
                            if (isset($_POST['min'])){$min = $_POST['min'];} else {$min = "";}
                            if (isset($_POST['cant_a'])){$cant_a = $_POST['cant'];} else {$cant_a = "";}

                            $sql = "INSERT INTO productos(fecha, codigo, descripcion, proveedor, cantidad, precio_compra, precio_venta, departamento, minimo, cant_actual) 
                            VALUES('$fecha', '$codigo', '$desc', '$prov', '$cant', '$pcompra', '$pventa', '$depto', '$min', '$cant_a')";
                            $result = mysql_query($sql);}
                                
                    ?>
				  </form>                                           
              </article>          
       	</section>      
       	 	
       <footer><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br>Copyright © 2017 KIM up - Escuela de Ingeniería en Informática</footer>		 
					 
   </body>          
</html>
