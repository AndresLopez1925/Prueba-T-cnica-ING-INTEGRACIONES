<?php // Este es el controlador para el Acceso al aplicativo    
     
     require_once '../Class/Persona.php';     
     require_once '../Controler/Funciones.php';
                  
 class ControladorAcceso
 {
     public static function IngresarSistema($documento)
     {
      $persona=NULL;     
      if ($documento!= NULL) 
      {                     
         $controlador = Funciones::CrearControlador();                          
         $persona =  $controlador->ObtenerPersona($documento); 
         if ($persona != NULL)
         {  
            $_SESSION['UsuarioConectado'] = $persona->getDocument();     
            $_SESSION['NombreUsuario']  = $persona->getName();                  
            $_SESSION['Envios']  = 1; 
            header("Location: ../Views/GenerarPago.php");                           
         }         
         else 
         {                
            header("Location: ../Views/Persona.php");    
         }
      }
    }         
       
 }


