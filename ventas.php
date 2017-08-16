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
        
        <script src="//ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>
        <script src="jquery.table2excel.js"></script>
    </head> 
    
   <body> 
       	<section>
              <img src="img/logo.png" alt="">
              <p>
                  <?php $fecha_actual = date('Y/m/d',time()-21600); 
                        $a=date("d"); 
                        $hora = date('H:i a',time()-21600); 
                        echo "Usuario: ".$_SESSION['nombre']." <br> 
                        $fecha_actual <br> 
                        $hora<br><br>                         
                        <a id = 'Volver' href = 'index.php'> Volver atrás </a><br>
                        <a href = 'login-salir.php'> Cerrar sesión </a>"
                  ?>
              </p>              
              <img id = "Horizontal" src="img/linea-h.png" alt="">
              
             
            <article id ='Inventario'> 
                    <form action="ventas.php" method="POST">  
                     <fieldset id = "productos">
				          <legend>VENTAS</legend><br><br>                               
                                                            
                      <?php
                            $day=date("m");
                            include("conexion.inc");
                            mysql_select_db("kimup", $BDD); 
                  
                            echo"<div id='uno'><div>FECHA: <input type='date' id ='if' name='fecha'/><input name='botonf' id='bf' value='Buscar' type='submit'/><input id='botonhh' value='EXPORTAR' type='submit'/></div></div><br><br><br><br>";
                  
                            if (isset($_POST['botonf'])) 
                            {   
                                $fecha = $_POST['fecha'];   
                                $sql1 = "SELECT SUM(a.precio_venta * b.cantidad) FROM productos a, ventas b WHERE a.codigo=b.codigo AND b.fecha='{$fecha}'";
                                $res = mysql_query($sql1); 
                                $sql2 = "SELECT SUM(precio_compra * cantidad) FROM productos";
                                $result2 = mysql_query($sql2); 

                                while ($row = mysql_fetch_row($res))
                                { 
                                    echo "<div id ='uno'>
                                           <div>TOTAL VENTA DEL DIA: <input id ='iv' value= $".number_format($row[0])." />";
                                } 	 

                                 while ($row = mysql_fetch_row($result2))
                                { 

                                     echo "       COSTO TOTAL: <input id ='iv' value= $".number_format($row[0])." /></div></div><br>";                                        
                                } 	            

                                 $sql = "SELECT a.codigo, a.descripcion, a.cantidad, b.cantidad,a.precio_venta * b.cantidad, ROUND((b.cantidad * 100 /a.cantidad),1),(((a.precio_venta * b.cantidad)*100)/(SELECT SUM(a.precio_venta * b.cantidad) FROM productos a, ventas b WHERE a.codigo=b.codigo AND b.fecha='{$fecha}')) FROM productos a, ventas b WHERE a.codigo=b.codigo AND b.fecha='{$fecha}'";
                                 $result = mysql_query($sql); 

                                 echo "<table class='Inventario'>";
                                    echo "<tr id='invh'>
                                                <td>Código</td>
                                                <td>Descripción</td>
                                                <td>Cant. inicial</td>
                                                <td>Vendido</td>
                                                <td>Total ventas</td>
                                                <td>% Vendido</td>
                                                <td>% Venta total</td>
                                          </tr><br>"; 

                                    while ($row = mysql_fetch_row($result))
                                    { 
                                        echo "<tr>
                                                    <td>$row[0]</td>
                                                    <td>$row[1]</td>
                                                    <td>$row[2]</td>
                                                    <td>$row[3]</td>                                                
                                                    <td>$".number_format($row[4])."</td>
                                                    <td>$row[5]%</td>
                                                    <td>$row[6]%</td>
                                             </tr>\n";                                     
                                    } 	                  
                                    echo "</table>";	                                
                            }    
                  
                            else
                            {
                            $sql1 = "SELECT SUM(a.precio_venta * b.cantidad) FROM productos a, ventas b WHERE a.codigo=b.codigo AND b.fecha='{$fecha_actual}'";
                            $res = mysql_query($sql1); 
                            $sql2 = "SELECT SUM(precio_compra * cantidad) FROM productos";
                            $result2 = mysql_query($sql2); 
                        
                            while ($row = mysql_fetch_row($res))
                            { 
                                echo "<div id ='uno'>
                                       <div>TOTAL VENTA DEL DIA: <input id ='iv' value= $".number_format($row[0])." />";
                            } 	 
                  
                             while ($row = mysql_fetch_row($result2))
                            { 
                                 
                                 echo "       COSTO TOTAL: <input id ='iv' value= $".number_format($row[0])." /></div>                                      
                                </div><br>";                                        
                            } 	            
                                 
                             $sql = "SELECT a.codigo, a.descripcion, a.cantidad, b.cantidad,a.precio_venta * b.cantidad, ROUND((b.cantidad * 100 /a.cantidad),1),(((a.precio_venta * b.cantidad)*100)/(SELECT SUM(a.precio_venta * b.cantidad) FROM productos a, ventas b WHERE a.codigo=b.codigo AND b.fecha='{$fecha_actual}')) FROM productos a, ventas b WHERE a.codigo=b.codigo AND b.fecha='{$fecha_actual}'";
                             $result = mysql_query($sql); 

                             echo "<table class='Inventario'>";
                                echo "<tr id='invh'>
                                            <td>Código</td>
                                            <td>Descripción</td>
                                            <td>Cant. inicial</td>
                                            <td>Vendido</td>
                                            <td>Total ventas</td>
                                            <td>% Vendido</td>
                                            <td>% Venta total</td>
                                      </tr><br>"; 

                                while ($row = mysql_fetch_row($result))
                                { 
                                    echo "<tr>
                                                <td>$row[0]</td>
                                                <td>$row[1]</td>
                                                <td>$row[2]</td>
                                                <td>$row[3]</td>                                                
                                                <td>$".number_format($row[4])."</td>
                                                <td>$row[5]%</td>
                                                <td>$row[6]%</td>
                                         </tr>\n";                                     
                                } 	                  
                                echo "</table>";	
                            }
                                
                           		
                        ?>
                        <br><br>                   
                        <script> 
                            $("#botonhh").click(function(){
                                $(".Inventario").table2excel({
                                exclude: "img",
                                name: "Ventas",
                                filename: "Ventas" 
                                });
                                });
                        </script>
                     </fieldset><footer>Copyright © 2017 KIM up - Escuela de Ingeniería en Informática</footer>	
				 
				   </form>                                                                         
              </article>          
       	</section>      
   </body>          
</html>
