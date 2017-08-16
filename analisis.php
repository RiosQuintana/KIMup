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
              
              
             <article id="analisis">   
                    <form action="analisis.php" method="POST" enctype="multipart/form-data">            
                      <fieldset id = "productos">
				          <legend>ANALISIS</legend><br><br><br>
                              <div id = "uno">                                                       
                                  <div>$: <input type="number" name="meta" maxlength="100"  placeholder=" Meta mensual"/></div>
                              </div>
                              <div id="dos">
                                  <div><input id="btn" type="submit" name="submit" value="ENVIAR"/> <input id="botonhh" value="EXPORTAR" type="submit"/>
                                      <br><br></div><br> 
                              </div><br><br>                                       
                                                                      
                                                                   
                    
                     <?php
                            $a=date("m");
                            $con = include("conexion.inc");  
                            mysql_select_db("kimup", $BDD);

                
                            if (isset($_POST['meta'])){$meta = $_POST['meta'];} else {$meta = "";}
                            
                            $sql = "TRUNCATE meta";
                  
                            $sql1 ="INSERT INTO meta(monto)VALUES('0')";
                  
                            $sql2="UPDATE meta SET monto=('$meta')";
                  
                            $sql3="SELECT ROUND((((SUM(a.precio_venta*b.cantidad))*100)/c.monto),2) FROM productos a, ventas b, meta c WHERE a.codigo=b.codigo AND month(b.fecha)='{$a}' ";
                  
                            $sql4="SELECT (SUM(b.cantidad_mermas)*100)/(SUM(a.cantidad)) FROM  mermas b, productos a WHERE month(b.fecha)='{$a}'";
                  
                            $sql5="SELECT (SUM(precio_compra))-(SELECT (SUM(a.precio_venta*b.cantidad)) FROM productos a,ventas b WHERE a.codigo=b.codigo AND month(b.fecha)='{$a}')FROM productos WHERE month(fecha)='{$a}'";
                  
                            $sql6="SELECT (((SUM(a.precio_venta*b.cantidad))*100)/((SUM(a.precio_venta*b.cantidad))+ (SUM(a.precio_compra*a.cantidad)))),(((SUM(a.precio_compra*a.cantidad))*100)/((SUM(a.precio_venta*b.cantidad))+ (SUM(a.precio_compra*a.cantidad)))) FROM productos a, ventas b WHERE month(b.fecha)='{$a}' AND month(a.fecha)='{$a}'";
                  
                            $sql7="SELECT a.departamento,SUM(a.precio_venta*b.cantidad),(((SUM(a.precio_venta*b.cantidad))*100)/(SELECT SUM(a.precio_venta * b.cantidad) FROM productos a, ventas b WHERE a.codigo=b.codigo)) from productos a, ventas b WHERE a.codigo=b.codigo AND month(b.fecha)='{$a}' GROUP BY a.departamento";
                            $result = mysql_query($sql);
                            $result1 = mysql_query($sql1);
                            $result2 = mysql_query($sql2);
                            $result3 = mysql_query($sql3);
                            $result4 = mysql_query($sql4);
                            $result5 = mysql_query($sql5);
                            $result6 = mysql_query($sql6);
                            $result7 = mysql_query($sql7);
                  
                  
                            echo "<table class='Historial'>";
                                    echo "<tr id='invh'>
                                            <td>Alcance meta</td>
                                            <td>Mermas</td>
                                            <td>Utilidad</td>
                                            <td>Venta</td>
                                            <td>Compra</td>
                                      </tr>"; 

                                      while ($row = mysql_fetch_row($result3))
                                      { echo "<tr><td>$row[0]%</td>"; } 	

                                      while ($row = mysql_fetch_row($result4))
                                      { echo "<td>$row[0]%</td>"; } 	
                  
                                      while ($row = mysql_fetch_row($result5))
                                      { echo "<td>$".number_format($row[0])."</td>"; }
                  
                                      while ($row = mysql_fetch_row($result6))
                                      {  echo "<td>$row[0]%</td>
                                                  <td>$row[1]%</td>
                                              </tr>\n"; 
                                      }                   
                                
                                echo "<th colspan =5>Participación departamentos</th>
                                      <tr id='invh'>
                                            <td colspan=3>Departamento</td>
                                            <td>Venta</td>
                                            <td>% venta</td>
                                      </tr>"; 
                                while ($row = mysql_fetch_row($result7))
                                { 
                                  echo "<td colspan=3>$row[0]</td><td>$".number_format($row[1])."</td><td>$row[2]%</td></tr>\n";                                     
                                }
                           echo "</table><br><br>";
                           
                          ?>
                          <script> 
                            $("#botonhh").click(function(){
                                $(".Historial").table2excel({
                                exclude: "img",
                                name: "Analisis",
                                filename: "Analisis" 
                                });
                                });
                        </script>  
                        </fieldset><footer>Copyright © 2017 KIM up - Escuela de Ingeniería en Informática</footer>	
				
				  </form>
              </article>          
       	</section>      
     </body>          
</html>
