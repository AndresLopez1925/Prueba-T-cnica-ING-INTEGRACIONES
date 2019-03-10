<?php 

require_once 'Conexion.php';
require_once '../Class/Persona.php';
require_once 'DataAcces1.php';

class AccesoDatos implements IAccesodatos{
    
    private $cn = NULL;      // Alias para la Conexion
    private $vecr = array(); // Vector con Resultados
  
   private static function BuscarRegistro($DatoBuscar)
   {            
     try 
     {           
        $cn = Conexion::ObtenerConexion();        
        
        //$rs= $cn->query("CALL placetopay.Proc_Buscar('" . $DatoBuscar . "')");
        $rs= $cn->query('CALL placetopay.Proc_Buscar(' .$DatoBuscar. ')');
        $vecresultado = array();
        while ($fila = $rs->fetch_row()) {
               array_push($vecresultado, $fila);                
        }
        mysqli_free_result($rs);
        mysqli_close($cn);
        return $vecresultado;
     }
     catch (Exception $ex)
     { 
       mysqli_close($cn);
       echo $ex;     
     }
   }
  
   

    public function GuardarPersona($persona) {
     $cn = Conexion::ObtenerConexion();    
     try
     {        
        $cn->query("SET @result = 1");
        $cn->query("CALL Proc_Personas('" . $persona->getDocumentType() . "',
                                       '" . $persona->getDocument() . "', 
                                       '" . $persona->getName() . "', 
                                       '" . $persona->getSurname() . "', 
                                       '" . $persona->getEmail() . "', 
                                       '" . $persona->getAddress() . "', 
                                       '" . $persona->getCity() . "',     
                                       @result)");

          $res = $cn->query("SELECT @result AS result");
          $row = $res->fetch_assoc();
          mysqli_close($cn);
          if($row['result'] == 0) {
            return 0;
          }
          else {
              return -1;
          }
   }
   catch (Exception $ex)
   {
       mysqli_close($cn);
       echo $ex;
   }     
 } 
  
    public function ObtenerPersona($DatoBuscar) {  
     try
        {         
          $vecr = AccesoDatos::BuscarRegistro($DatoBuscar);
          if ($vecr!= NULL)
          {
            $persona = new Persona();
            $persona->setPerson_id($vecr[0][0]);
            $persona->setDocumentType ($vecr[0][1]);
            $persona->setDocument($vecr[0][2]); 
            $persona->setName($vecr[0][3]); 
            $persona->setSurname($vecr[0][4]); 
            $persona->setEmail($vecr[0][5]); 
            $persona->setAddress($vecr[0][6]); 
            $persona->setCity($vecr[0][7]);
            $vecr = NULL;
            return $persona;
          }
          else
          {
              return NULL;
          }
       }
       catch (Exception $ex)
       {
           echo $ex;
       }   
    }

}

?>