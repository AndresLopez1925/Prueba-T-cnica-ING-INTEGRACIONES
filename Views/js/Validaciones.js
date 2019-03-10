function VerificarAcceso() {  
  document.getElementById("itDocumento").value = document.getElementById("itDocumento").value.replace(/^\s+|\s+$/g,"");
  if (document.getElementById("itDocumento").value === ""){
      document.getElementById("itMensajeError").value = "Documento es requerido";      
      document.getElementById("itDocumento").focus();
      return false;
  }
   if (document.getElementById("itDocumento").value.length < 6) 
   { 	
      document.getElementById("itMensajeError").value = 'Documento debe ser mayor de 6 digitos';	
      document.getElementById("itDocumento").focus();
      return false;
   }  
   return true;
}


function VerificarPersonas()
{
  document.getElementById("itDocumento").value = document.getElementById("itDocumento").value.replace(/^\s+|\s+$/g,"");
  if (document.getElementById("itDocumento").value === ""){
      document.getElementById("itMensajeError").value = "Documento es requerido";      
      document.getElementById("itDocumento").focus();
      return false;
  } 
   if (document.getElementById("itDocumento").value.length < 6) 
   { 	
      document.getElementById("itMensajeError").value = 'Documento debe ser mayor de 6 digitos';	
      document.getElementById("itDocumento").focus();
      return false;
   }
   if (document.getElementById("itDocumento").value.substring(0,1)==='0') 
   { 	
       document.getElementById("itMensajeError").value = 'Error, primera cifra no puede ser 0';	
       document.getElementById("itDocumento").focus();             
       return false;
   }
   document.getElementById("itNombres").value = document.getElementById("itNombres").value.replace(/^\s+|\s+$/g,"");
   if (document.getElementById("itNombres").value === "")
   {    
        document.getElementById("itMensajeError").value= 'Nombres es requerido';
        document.getElementById("itNombres").focus();
	return false;
   }
   document.getElementById("itApellidos").value = document.getElementById("itApellidos").value.replace(/^\s+|\s+$/g,"");
   if (document.getElementById("itApellidos").value === "")
   {    
        document.getElementById("itMensajeError").value= 'Apellidos es requerido';	
        document.getElementById("itApellidos").focus();
	return false;
   }
   document.getElementById("itCorreo").value = document.getElementById("itCorreo").value.replace(/^\s+|\s+$/g,"");
   if (document.getElementById("itCorreo").value.length > 0)
   {
    if( !(/\w+([-+.']\w+)*@\w+([-.]\w+)*\.\w+([-.]\w+)*/.test(document.getElementById("itCorreo").value)) )                        
     {
       document.getElementById("itMensajeError").value= 'Formato de correo errado';
       document.getElementById("itCorreo").focus();   
       return false;    
     }
   }
   document.getElementById("itDireccion").value = document.getElementById("itDireccion").value.replace(/^\s+|\s+$/g,"");
   if (document.getElementById("itDireccion").value === "")
   {    
        document.getElementById("itMensajeError").value= 'Direccion es requerido';	
        document.getElementById("itDireccion").focus();
	return false;
   }
   return true;
}

function ConfirmarCompra()
{
 if (confirm("¿ Esta seguro que desea efectuar esta compra ?")) 
 {
   return true;
 }
 return false;
}