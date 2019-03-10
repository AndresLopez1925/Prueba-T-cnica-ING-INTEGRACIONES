<?php     
     require_once '../Class/Payment.php';
     require_once '../Controler/Funciones.php';
     
class ControladorCompra {
    
    public static function ProcesarCompra()        
    {           
        $ContadorIntentos = $_POST['itCampoClave'];
        $payment = new Payment();
        $payment->setReferencia(filter_input(INPUT_POST, 'itReferencia',FILTER_SANITIZE_STRING));
        $payment->setDescription(filter_input(INPUT_POST, 'itDescripcion',FILTER_SANITIZE_STRING));
        $payment->setCurrency(filter_input(INPUT_POST,'slTipoMoneda'));      
        $payment->setTotal(filter_input(INPUT_POST, 'itTotal',FILTER_SANITIZE_NUMBER_INT));
        
            //================================================================
            //      Obtener Parametros Autenticacion
            //================================================================
            $login = '6dd490faf9cb87a9862245da41170ff2';
            $secretKey = "024h1IlD";

            if (function_exists('random_bytes')) {
            $nonce = bin2hex(random_bytes(16));
            } elseif (function_exists('openssl_random_pseudo_bytes')) {
               $nonce = bin2hex(openssl_random_pseudo_bytes(16));
            } else {
               $nonce = mt_rand();
            }
            $nonceBase64 = base64_encode($nonce);
            $seed = date('c');
            $tranKey = base64_encode(sha1($nonce . $seed . $secretKey, true));                
            //================================================================
         
            
            if ($payment != NULL)
            {           
                //===============================================================================================
                //             Construir JSON
                //===============================================================================================
                
                $inicio = '{ "auth": ';
                $autn = array('login' => $login, 'seed' => $seed, 'nonce' => $nonceBase64, 'tranKey' => $tranKey);
                
                $cadena1 = ',
                        "payment": ';                       
                   
                    $strjson = $inicio . json_encode($autn) . $cadena1 . json_encode($payment);
                    
                    $url = 'https://test.placetopay.com/redirection/api/session';
                    
                    $var = substr($strjson, 0, (strlen($strjson)-1));
                 
                $cadena2 = ',
                            "amount":';    
                
                $amount = array('currency' => $payment->getCurrency(), 'total' => $payment->getTotal());
                
                $cadena3 = '   },
                                "expiration": "2019-08-01T00:00:00-05:00",
                                "returnUrl": "https://dev.placetopay.com/redirection/sandbox/session/5976030f5575d",
                                "ipAddress": "127.0.0.1",
                                "userAgent": "PlacetoPay Sandbox"
                            }';
                           
                $payload=  $var . $cadena2 . json_encode($amount) . $cadena3;
                //===============================================================================================
                //             Procesar URL 
                //===============================================================================================
                $ch = curl_init($url);
                curl_setopt($ch, CURLOPT_POSTFIELDS, $payload);
                curl_setopt($ch, CURLOPT_HTTPHEADER, array('Content-Type:application/json'));
                curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);                                
                $response = json_decode(curl_exec($ch), true);                         
                curl_close($ch);                
                
                if ($response['status'] == 'OK')  
                {
                  $mensaje= 'Intentos de envio: ' . $ContadorIntentos;  
                  header("Location: ../Views/Replay.php?respuesta=R&mensaje=$mensaje");   
                }
                else 
                {    
                   // Incrementar cantidad de intentos de envio  
                   $_SESSION['Envios'] = $_SESSION['Envios']+1;                   
                }
            }      
            
              
    }
}


