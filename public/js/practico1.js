
$(document).ready(function(){
    
    $("#btnEnviar").click(function(){
        
        var datos= {
            time_out:$("#input_timeout").val(),
            format:$("#input_format").val(),
            http_code:$("#input_httpcode").val(),
            mensaje:$("#input_mensaje").val()
            
        }
        
        $.ajax({
            url:"http://api.marcelocaiafa.com",
            data:datos,
            //tipo de metodo que invoco a esta API
            type:"GET",
            //Cuanto tiempo espero antes del timeout
            timeout:2000,
            dataTyoe:"json",
            //si el server responde con 200 es OK
            success: function(response){
                
                console.log(response);
                $("#resultado").html(response)
                
            },
            error:function(xmlrequest, status, txterror){
                
                if (status=='timeout'){
                    console.log("Operacion cancelada, e servidor no responde")
                }
                else if (status=='parseerror' && xmlrequest.status ==200)
                {
                    console.log("Operacion cancelada, e servidor respondio algo que esta en el formato esperado")
                } else {
                     console.log("Operacion cancelada, e servidor respondio un codigo hhtp !200")
                     console.log(xmlrequest.status, xmlrequest.statusText)
                }
            }
            
        })
    })
})

