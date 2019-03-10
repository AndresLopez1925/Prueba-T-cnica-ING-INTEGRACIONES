<!DOCTYPE html>
<html>
    <head>			
          <meta http-equiv='Content-Type' content='text/html; charset=UTF-8'> 
          <title>Acceso</title>                  
          <script src='../resources/js/Validaciones.js' type='text/javascript'></script>
    </head>    
    <body>        
            <?php 
                 
                 require_once '../Views/Style.php';                          
                 require_once '../Controler/AccesControler.php';  
                 require_once '../Controler/Funciones.php';  

               $mensajeError =  NULL;
               $documento=NULL;
               if ( !empty($_POST))
               {     
                $mensajeError =  MensajeCampoRequerido;     
                $documento=trim(filter_input(INPUT_POST, 'itDocumento', FILTER_SANITIZE_STRING));                           
                $ingresar = true;
                
                if (Funciones::Validar_CampoVacio($documento)) {
		               $ingresar = false;
                    $mensajeError ='Documento'.' '.MensajeCampoRequerido;	                    
		}  
                if(strlen($documento) < 6){
                    $ingresar = false;                    
                }
                if ($ingresar)
                {             
                  ControladorAcceso::IngresarSistema($documento);
                }
               } 
	?>

        <form id='frmAcceso' 
              name='frmAcceso'
              action='index.php'
              class='formoid-solid-green'
              style="background-color:#FFFFFF; font-size:12px; font-family:'Arial',Helvetica,sans-serif;
                     max-width:450px;
                     min-width:200px" 
              method="post">
            
         <div class="title" style="background-color:orange ;color: black">
          <h2>
            <i class="fa fa-key" style="background-color:orange ;color: black"></i>&nbsp;
            <strong>Loggin</strong>
          </h2>
        </div>
         
	 <div class="element-name">
              <p></p>
             <div class="col-lg-8">
                  <input class="medium" type="text" id="itDocumento" name="itDocumento" required="required" placeholder="Usuario" title="Usuario Registrado"
                   onkeypress="return ValidarNumeros(event)" 
                   onkeydown="return AnularPegado(event)"
                    value="<?php echo !empty($documento)?$documento:'';?>"/>                
                  <span class="icon-place"></span>
              </div>
              <p></p>
         </div>
        <div>
          <label>Si no está registrado &nbsp;<a href="../Views/Persona.php">Regístrese aquí </a></label>
        </div>        
         <div>
             <input class="large" type="text" id="itMensajeError" name="itMensajeError" readonly="true"
                     style=" border-style: none; color: red; background: white"
                     value="<?php echo !empty($mensajeError)?$mensajeError:'';?>"/>              
         </div>
         <div class="container">
         <div class="submit" >
             <input type="submit" style="background-color:orange ;color: black;font-weight: bold"   
                    value="Ingreso" class="btn btn-default btn-lg"
                     onmousedown="return VerificarAcceso();"/>
        </div>
         </div>  
   </body>
 </html>