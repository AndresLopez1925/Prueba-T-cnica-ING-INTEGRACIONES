<?php // Esta es una clase, desde donde se instancia el Factory Method
     require_once '../Controler/Manager.php';
     require_once '../Controler/AccesData.php';
     
class Funciones
{   
   
   public static function CrearControlador()
   {
        $accesodatos = new AccesoDatos();
        $accesodatos = AccesoDatosFactory::ObtenerAccesoDatos($accesodatos);       
        return new Controlador($accesodatos);
    }
    
   public static function Validar_CampoVacio($Cadena)
   {
     if (trim($Cadena) == NULL)   // Validar Campo en blanco
     {
        return true;
     }
     return false;
     
   } 
   
   public static function Validar_Correo($Cadena)
   {            
     if(filter_var($Cadena, FILTER_VALIDATE_EMAIL) == FALSE)  
     {
        return false;
     }
     else 
     {            
        return true;
     }
   }
  
}


