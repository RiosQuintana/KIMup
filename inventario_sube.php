 <?php
    
    $con = include("conexion.inc");  
    mysql_select_db("kimup", $BDD);

    if(isset($_POST["submit"]))
    {
          $canta = $_POST["canta"];
          $codigo = $_POST["codigo"];
          $sql="UPDATE productos SET cant_actual='".$canta."' WHERE codigo='".$codigo."'";
          $result = mysql_query($sql);   
    }

    if($result)
    {
		header("Location: inventario.php");
	}

?>	