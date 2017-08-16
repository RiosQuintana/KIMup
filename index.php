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
        <script type="text/javascript" src="jquery214.js"></script>		
		<script type="text/javascript">
            
            $(document).ready(Principal);            
            function Principal() 
            { 
                $("td").mouseover(a); 
                $("td").mouseout(b); 
            }
            
            function a() { $(this).css({"background-color": "rgba(0,255,0,0.2"});
                          $("img", this).css({"width": "45%", "height": "auto", "display":"block","margin": "10px auto 10px auto"});}  
            
            function b() { $(this).css({"background-color": "rgba(0,0,0,0.05)"});                         
                           $("img", this).css({"width": "40%", "height": "auto", "display":"block","margin": "20px auto 20px auto"});}
        </script> 
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
                        <a href = 'login-salir.php'> Cerrar sesión </a>"
                  ?>
              </p>
              
              <img id = "Horizontal" src="img/linea-h.png" alt="">
                
               
              <article>
                 
                  <table id='index'>
                      <tr id='indextr'>
                          <td id="indextd"><a href="Producto.php"><img src="img/Producto.png" title="Ingresar producto"/></a></td>
                          <td id="indextd"><a href="Inventario.php"><img src="img/Inventario.png"  title="Inventario"></a></td>
                          <td id="indextd"><a href="Mermas.php"><img src="img/Mermas.png"  title="Mermas"></a></td>
			          </tr>   
                       
                      <tr id='indextr'>
                          <td id="indextd"><a href="ventas.php"><img src="img/Ventas.png" alt=""></a></td>
                          <td id="indextd"><a href="Historial.php"><img src="img/dia.png" alt=""></a></td>
                          <td id="indextd"><a href="analisis.php"><img src="img/grafico.png" alt=""></a></td>
			          </tr>
			            
			      </table>			
			                  
			 </article>	
          
       	</section>
       <footer>Copyright © 2017 KIM up - Escuela de Ingeniería en Informática</footer>      			 
					 
   </body>          
</html>
