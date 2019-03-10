<?php // Interface que expone todo lo que el DAL (Capa Acceso Datos) implementa

interface IAccesoDatos {
    
    public function ObtenerPersona($DatoBuscar);     // Obtiene una Persona
    public function GuardarPersona($persona);        // Ingresa una Persona
    
}
