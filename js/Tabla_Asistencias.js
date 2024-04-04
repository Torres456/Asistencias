$(buscarDatos());

function buscarDatos(consulta){
$.ajax({
url:'BD/Carga_asistencia.php',
type:'POST',
dataType:'html',
cache:'none',
data:{consulta : consulta},
})
.done(function(respuesta){
    $("#datos").html(respuesta);
})
.fail(function(){
console.log("error");
})
}

$(document).on('keyup','#datos',function(){
var valor=$(this).val();
if(valor !=""){
    buscarDatos(valor);
}else{
    buscarDatos();
}
})