<!DOCTYPE html>
<html>
    <head>     
          <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
          <title>Acceso</title>                            
          <script src="js/Validaciones.js" type="text/javascript"></script>
    </head>    
    <body>        
       <?php           
          require_once '../Views/Style.php';
          require_once '../Class/Persona.php';
          require_once '../Controler/PersonControler.php';         
          require_once '../Controler/Funciones.php';
          require_once '../Controler/AccesControler.php'; 
                   
          $mensajeError= NULL;          
          $tipodocumento= NULL;
          $documento= NULL;
          $nombres = NULL;
          $apellidos = NULL;          
          $correo =NULL;
          $direccion =NULL;       

          $controlador = Funciones::CrearControlador();
         
            if ( !empty($_POST)) {           
                $id=filter_input(INPUT_POST,'itCampoClave');  
                $tipodocumento =filter_input(INPUT_POST,'slTipoDocumento');
                $documento=trim(filter_input(INPUT_POST,'itDocumento',FILTER_SANITIZE_STRING));
                $nombres =trim(ucwords(strtolower(filter_input(INPUT_POST, 'itNombres',FILTER_SANITIZE_STRING))));
                $apellidos =trim(ucwords(strtolower(filter_input(INPUT_POST, 'itApellidos',FILTER_SANITIZE_STRING))));
                $empresa=(filter_input(INPUT_POST, 'itEmpresa',FILTER_SANITIZE_STRING));  
                $correo=(filter_input(INPUT_POST, 'itCorreo', FILTER_SANITIZE_EMAIL)); 
                $direccion=filter_input(INPUT_POST, 'itDireccion',FILTER_SANITIZE_STRING);                
                $ciudad =filter_input(INPUT_POST,'slCiudades');
            
             $grabar = true;
                if (Funciones::Validar_CampoVacio($documento)){                
                        $grabar = false;
			$mensajeError ='Documento'.' '.MensajeCampoRequerido;			
		}          
               if (!preg_match("/^[0-9]+$/", $documento)){                
                        $grabar = false;
                        $mensajeError = Mensaje5;
                }
                if(strlen($documento) < 6){
                    $grabar = false;
                    $mensajeError = Mensaje2;		     
                }
                if(substr($documento,0,1) ==0){
                    $grabar = false;
                    $mensajeError = Mensaje1;		     
                }	
                if (Funciones::Validar_CampoVacio($nombres)){    
                        $grabar = false;
			$mensajeError ='Nombres'.' '.MensajeCampoRequerido;		
		}
                if (Funciones::Validar_CampoVacio($apellidos)){   
                        $grabar = false;
			$mensajeError = 'Apellidos'.' '.MensajeCampoRequerido;		
		}	                
                
                if (Funciones::Validar_CampoVacio($direccion)){   
                        $grabar = false;
			$mensajeError = 'Direccion'.' '.MensajeCampoRequerido;			
		}                                           
                
                if ($correo != '') {
                   if (!Funciones::Validar_Correo($correo)){
                       $grabar = false; 
                       $mensajeError = Mensaje3;                       
                     }
                }                                                                      
                
                if ($grabar)
                {     
                  ControladorPersona::GrabarPersona();                    
                }
          }
       ?>
                
           <form name="Persona" 
              action="Persona.php" 
              class="formoid-solid-green" 
              style="background-color:#FFFFFF;
                     font-size:12px;
                     font-family:'Roboto', Arial,Helvetica,sans-serif;
                     color:#34495E;
                     max-width:550px;
                     min-width:210px"
              method="post">
         
         <div class="title" style="background-color:orange ;color: black">
          <h2>
            <i class="fa fa-group"></i>&nbsp;Personas</h2>
          </div>
	       
          <div class="element-name">
             <span class="nameFirst">
                        <select id="slTipoDocumento" name="slTipoDocumento" >
                                <option value="Seleccione una Opcion">Seleccione una Opcion</option>
                                <option value="CC">Cedula</option>
                                <option value="TI">Tarjeta Identidad</option>
                                <option value="NT">Nit</option>
                                <option value="RUT">Rut</option>
                        </select>        
                
                <span class="icon-place"></span>
               
                </span><span class="nameLast">
                
                  <input class="small"
                         type="text"
                         id="itDocumento"
                         name="itDocumento"                         
                         maxLength="10"      
                         placeholder="Digite Su documento de Indentidad"
                         required="required"
                         onkeypress="return ValidarNumeros(event)" 
                         onkeydown="return AnularPegado(event)" 
                         value="<?php echo !empty($documento)?$documento:'';?>"/>          
                <span class="icon-place"></span></span>
        </div>      
	<div class="element-name">
             <span class="nameFirst">
                <input type="text"                       
                       id="itNombres" 
                       name="itNombres" 
                       required="required"
                       maxLength="25"        
                       placeholder="Digite su Nombre"
                       onkeypress="return SoloLetras(event)"    
                       onkeydown="return AnularPegado(event)"
                       value="<?php echo !empty($nombres)?$nombres:''; ?>"/>          
                <span class="icon-place"></span>               
                </span><span class="nameLast">                
                <input type="text"                        
                       id="itApellidos"
                       name="itApellidos"                        
                       required="required"             
                       maxLength="25"
                       placeholder="Digite su Apellido"
                       onkeypress="return SoloLetras(event)"
                       onkeydown="return AnularPegado(event)"
                       value="<?php echo !empty($apellidos)?$apellidos:''; ?>"/>            
                <span class="icon-place"></span></span>
        </div>
       <div class="element-email">
                 <div class="item-cont">
                      <input class="medium" 
                             type="email"                              
                             id="itCorreo"
                             name="itCorreo" 
                             required="required"
                             placeholder="Correo Electronico"
                             maxLength="50" style=" width: 100%;"
                             value="<?php echo !empty($correo)?$correo:'';?>">
                      
                      <span class="icon-place"></span>
                 </div>
             </div> 
                 <div class="element-select">
             <div class="item-cont">
                <div class="medium">
                    <span>
                        <select id="slCiudades" name="slCiudades" >
                                <option value="Cali">Cali</option>
                                <option value="Bogota">Bogota</option>
                                <option value="Medellin">Medellin</option>
                                <option value="B/quilla">B/quilla</option>
                        </select>
                        <span class="icon-place"></span>                    
                    </span>
                </div>
             </div>
         </div>      
	     <div class="element-input">
                 <div class="item-cont">
                      <input class="large" 
                             type="text" 
                             id="itDireccion" 
                             name="itDireccion" 
                             maxlength="50"  
                             required="required" 
                             placeholder="Direccion Residencia"                                              
                             value="<?php echo !empty($direccion)?$direccion:'';?>"/>
                      <span class="icon-place"></span>
                 </div>
             </div>
              <input class="large" 
                     type="text" 
                     id="itMensajeError" 
                     name="itMensajeError" 
                     readonly="true"
                     style=" border-style: none; color: red; background: white"
                     value="<?php echo !empty($mensajeError)?$mensajeError:'';?>"/> 
                     <div class="container">             
         <div class="submit">
              <input type="submit" 
                     value="Enviar" style="background-color:orange ;color: black;font-weight: bold" class="btn btn-default btn-lg"
                     onmousedown="return VerificarPersonas();">             
              </input>
        </div>  
        </div> 
     </form>      
   </body>
 </html>
