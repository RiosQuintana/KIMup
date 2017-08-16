<?php
                    $a=date("m");
                    include("conexion.inc");  
                    mysql_select_db("kimup",$BDD);  
                    $consulta = "UPDATE productos INNER JOIN ventas ON productos.codigo = ventas.codigo
                    SET productos.cant_actual = productos.cant_actual - ventas.cantidad WHERE productos.codigo = ventas.codigo";   
                    $resp = mysql_query($consulta, $BDD);				
?>

<html> 
<head> 
<title>Redirigir al navegador a otra URL</title> 
<META HTTP-EQUIV="REFRESH" CONTENT="0;URL=inventario.php"/> 
</head>  
</html>