<html>
<head>
      <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
      <title>Respuesta</title>
</head>

<body>
    <?php 
          session_start();
          require_once '../Views/Style.php';
          $respuesta = filter_input(INPUT_GET,'respuesta');
          session_destroy();
    ?> 
 
            <form name="Replay" 
                  action="Replay.php"
                  class="formoid-solid-green" 
                  style="background-color:#FFFFFF;
                         font-size:12px;
                         font-family:'Roboto', Arial,Helvetica,sans-serif;
                         color:#34495E;
                         max-width:480px;
                         min-width:150px">                  
                
                <div class="title" style="background-color:orange ;color: black">                                       
                    <?php if($respuesta == "R"){ ?>  
                    <h2><img src="../resources/Imagenes/Informacion.png" alt=""/></h2> 
                    
                    <?php } ?>     
                    <?php if($respuesta == "E"){ ?>
                    <h2><img src="../resources/Imagenes/Error.png" alt=""/></h2>
                    <?php } ?>  
                </div>
                
                <br></br>
                
                <div>
                    <input class="large" 
                           type="text" 
                           id="itMensajeError" 
                           name="itMensajeError" 
                           readonly="true"
                           style=" border-style: none; color: red; background: white"
                           value="<?php echo filter_input(INPUT_GET,'mensaje'); ?>"/>         
                </div>
                <br></br>
                <div align="center">
                    <a href="index.php" style="font-size:20px"><i class="fa fa-home"></i>&nbsp;Regresar Inicio</a>
                </div>    
                <br></br>
            </form>     
</body>
</html>
