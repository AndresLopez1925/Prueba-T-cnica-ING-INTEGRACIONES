<?php // Este es el controlador para el registro de Operarios
     require_once '../Class/Persona.php';     
     require_once '../Controler/Mensajes.php';   
     require_once '../Controler/Funciones.php';
     
class ControladorPersona {
     public static function GrabarPersona()
     {       
       $persona = new Persona();       
       $persona->setDocumentType(filter_input(INPUT_POST, 'slTipoDocumento',FILTER_SANITIZE_STRING));
       $persona->setDocument(filter_input(INPUT_POST, 'itDocumento',FILTER_SANITIZE_STRING));
       $persona->setName(ucwords(strtolower(filter_input(INPUT_POST, 'itNombres',FILTER_SANITIZE_STRING))));
       $persona->setSurname(ucwords(strtolower(filter_input(INPUT_POST, 'itApellidos',FILTER_SANITIZE_STRING))));               
       $persona->setEmail(strtolower(filter_input(INPUT_POST, 'itCorreo', FILTER_SANITIZE_EMAIL)));       
       $persona->setAddress(filter_input(INPUT_POST, 'itDireccion', FILTER_SANITIZE_STRING));       
       $persona->setCity(filter_input(INPUT_POST, 'slCiudades',FILTER_SANITIZE_STRING)); 
     
       $controlador = Funciones::CrearControlador();       
       $Resultado = $controlador->GuardarPersona($persona);         
       
       if ($Resultado==0) 
       {
         $mensaje=NULL;  
         $_SESSION['UsuarioConectado'] = $persona->getPerson_id();  
         $_SESSION['NombreUsuario']= $persona->getName();         
        // header("Location: ../Views/GenerarPago.php");   
       }
       else
       {
           $mensaje= MensajeErrorBD;           
           header("Location: ../Views/Replay.php?respuesta=E&mensaje=$mensaje"); 
       }
     }

}



