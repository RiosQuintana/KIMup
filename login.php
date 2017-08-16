<!DOCTYPE html>
<html>
	<head>  		
		<meta charset="UTF-8">
		<meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
        <title>KIM up</title>  
        <link rel="stylesheet" href="General.css" type="text/css" media="screen">  
	</head> 
     
    <body> 
        <p id="p1">Bienvenido a KIMup</p>
        <p>Para iniciar sesión ingrese su usuario y contraseña</p>
        <img id="Logo" src = "img/Logo.png" alt="">		
        <img id="Linea" src = "img/linea.png" alt="">
        
		<form action="login-validar.php" method="GET">  
                     
            <p><input type="text" name="usuario" placeholder="  Usuario" required="required" maxlength="10" /></p>
		    <p><input type="password" name="clave" placeholder="  Contraseña" required="required" maxlength="10" /></p>
			<p><input id="Entrar" type="submit" name="submit" value="Entrar" /></p>
               
            <?php 
                if (isset($_REQUEST['error']))
				{
					$error = $_REQUEST['error'];
				}
				else
				{
					$error = "";
				}
				echo "<br><b>$error</b>"; 
            ?>  
                
        </form>				 
   </body>          
</html>
