<?php
     session_start();       
     require_once '../Connect/DataAcces.php';       
     
 class Controlador  {
    
    protected $iaccesoDatos;
    
    public function __construct(IAccesodatos $iaccesoDatos)
    {
        $this->iaccesoDatos=new AccesoDatos();
    }             
  
    public function ObtenerListadoUsuarios() 
    {
       return $this->iaccesoDatos->ObtenerListadoUsuarios();
    }
    
    public function ObtenerPersona($DatoBuscar)
    {
        return $this->iaccesoDatos->ObtenerPersona($DatoBuscar);
    }
    
    public function GuardarPersona ($Object)
    {
       return $this->iaccesoDatos->GuardarPersona($Object); 
    }
    
    public function EliminarUsuario ($DatoEliminar)
    {
       return $this->iaccesoDatos->EliminarUsuario($DatoEliminar); 
    }
 }
