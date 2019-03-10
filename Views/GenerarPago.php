<!DOCTYPE html>
<html>
    <head>     
          <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
          <title>Generar Pago</title>             
          <script src="js/Validaciones.js" type="text/javascript"></script>
    </head>    
    <body>       
         <?php             
               require_once '../Views/Style.php';                          
               require_once '../Controler/ControlerPay.php';  
               require_once '../Controler/Funciones.php';  
               require_once '../Class/Payment.php';  
               
               $id = $_SESSION['Envios'];
               $mensajeError= NULL;
               $referencia=NULL;
               $descripcion='Pago basico';
               $moneda=NULL;  
               $total=NULL;               
                                        
               if ( !empty($_GET['id']))
               {
                  $id = base64_decode(INPUT_GET, 'id');    
               }
                
               if ( !empty($_POST))
               {     
                    $id =trim(filter_input(INPUT_POST, 'itCampoClave', FILTER_SANITIZE_NUMBER_INT));
                    $referencia=trim(filter_input(INPUT_POST,'itReferencia',FILTER_SANITIZE_STRING));
                    $descripcion=trim(filter_input(INPUT_POST,'itDescripcion',FILTER_SANITIZE_STRING));
                    $moneda=trim(filter_input(INPUT_POST,'slTipoMoneda',FILTER_SANITIZE_STRING));  
                    $total=trim(filter_input(INPUT_POST,'itTotal',FILTER_SANITIZE_NUMBER_INT));
                    
                    $grabar = true;
                    if (Funciones::Validar_CampoVacio($referencia)){                
                        $grabar = false;
			$mensajeError ='Referencia'.' '.MensajeCampoRequerido;			
		    }          
                    if (Funciones::Validar_CampoVacio($descripcion)){                
                        $grabar = false;
			$mensajeError ='Descripcion'.' '.MensajeCampoRequerido;			
		    }          
                    if (Funciones::Validar_CampoVacio($total)){                
                        $grabar = false;
			$mensajeError ='Total'.' '.MensajeCampoRequerido;			
		    }          
                    if (!preg_match("/^[0-9]+$/", $total)){                
                             $grabar = false;
                             $mensajeError = Mensaje5;
                     }
                    if(substr($total,0,1) ==0){
                        $grabar = false;
                        $mensajeError = Mensaje1;		     
                    }	                    
                    
                    if ($grabar)
                    {                        
                        ControladorCompra::ProcesarCompra();                    
                    }
               }
        ?>
       
        <form name="GenerarPago" action="GenerarPago.php" class="formoid-solid-green" style="background-color:#FFFFFF;
                     font-size:12px;
                     font-family:'Roboto',Arial,Helvetica,sans-serif;
                     color:#34495E;
                     max-width:480px;
                     min-width:150px" 
              method="post">            
            
         <input id="itCampoClave" name="itCampoClave" type="hidden" value="<?php echo !empty($id)?$id:1;?>"/> 
         
         <div class="title" style="background-color:orange ;color: black"><h2><i class="fa fa-money"></i>&nbsp;Generar Pago</h2></div>
         
         <label class="titulos"><?php echo 'Bienvenido:'." ".$_SESSION['NombreUsuario'];?></label>
         
              <div class="element-name">
             <span class="nameFirst">
             <label class="title">
                    <span class="required"> Referencia </span>
             </label>                     
                </span><span class="nameLast">                
                  <input class='small' type='text'
                         id="itReferencia"
                         name="itReferencia"                         
                         maxLength="15"      
                         placeholder="Referencia Pago"
                         required="required"
                         value="<?php echo !empty($referencia)?$referencia:'';?>"/>          
                <span class="icon-place"></span></span>
        </div>
                      <div class="element-name">
             <span class="nameFirst">
             <label class="title">
                    <span class="required">
                          Descripcion
                    </span>
             </label>                   
                </span><span class="nameLast">                
                  <input class="medium"
                         type="text"
                         id="itDescripcion"
                         name="itDescripcion"                         
                         maxLength="50"      
                         required="required"
                         value="<?php echo !empty($descripcion)?$descripcion:'';?>"/>         
                <span class="icon-place"></span></span>
        </div> 
                              <div class="element-name">
             <span class="nameFirst">
             <label class="title">
                    Tipo Moneda
             </label>                 
                </span><span class="nameLast">                
                        <select id="slTipoMoneda" name="slTipoMoneda" >
                                <option value="COP">COP</option>
                                <option value="USD">USD</option>
                                <option value="EUR">EUR</option>
                        </select>        
                <span class="icon-place"></span></span>
        </div>    
                                      <div class="element-name">
             <span class="nameFirst">
             <label class="title">
                    <span class="required"> Total </span>
             </label>                
                </span><span class="nameLast">                
                  <input class="small"
                         type="text"
                         id="itTotal"
                         name="itTotal"                         
                         maxLength="10"      
                         placeholder="Solo Numeros"
                         required="required"
                         onkeypress="return ValidarNumeros(event)" 
                         onkeydown="return AnularPegado(event)" 
                         value="<?php echo !empty($total)?$total:'';?>"/>         
                <span class="icon-place"></span></span>
        </div>                      
                
            <input class='large' type='text' id='itMensaje' name='itMensaje' readonly='true'
                           style=" border-style: none; color: blue; background: white"
                           value="<?php echo !empty($mensajeError)?$mensajeError:'';?>"/> 
                           <div class="container">         
        <div class='submit'>
             <input type='submit' value='Aeptar' style="background-color:orange ;color: black;font-weight: bold"   
             class="btn btn-default btn-lg"
             onmousedown="return VerificarCompra();"/>
         </div> 
         </div>                           
        </form>
    </body>
</html>
