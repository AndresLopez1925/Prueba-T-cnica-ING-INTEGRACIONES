<?php // Clase que nos devuelve la conexion con el proveedor que se desee

class Conexion {
 
 public static function ObtenerConexion()
 {
    try
    {       
         $Conexion = new mysqli('localhost:33065', 'root', '');
        //$conect =mysql_connect('localhost:33065','root','');
        //$Conexion = new mysqli('localhost', 'root', '');
         if (mysqli_connect_errno()){       
            die("No se puede conectar a la base de datos:");
        }
        else 
        {
           return($Conexion);
        }         
    }
    catch (Exception $ex)
    { 
       echo $ex;     
    }
 }

}

?>
