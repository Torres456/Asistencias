let select = document.getElementById('Servicio');

select.addEventListener('change', () => {
    let valorOption = select.value;

    document.getElementById('Consulta').value = '';

    if (valorOption == '0') {
        buscarDatos(0);

    } else if (valorOption == '1') {

        buscarDatos(1);

    } else if (valorOption == '2') {
        buscarDatos(2);

    }
});



let Opcion= select.value;
$(buscarDatos(Opcion,"",""));


function buscarDatos(accion,consulta,option) {
    $.ajax({
        url: '../BD/Tabla_panelA.php',
        type: 'POST',
        dataType: 'html',
        cache: 'none',
        data: { 
            consulta: consulta,
            Accion: accion,
            Opcion: option
        
        },
    })
        .done(function (respuesta) {
            $("#Datos").html(respuesta);
        })
        .fail(function () {
            console.log("error");
        })
}

$(document).on('keyup', '#Consulta', function () {
    let Opcion= select.value;
    var valor = $(this).val();
    if (valor != "") {
        buscarDatos("",valor,Opcion);
    } else {
        buscarDatos(Opcion,"","");
    }
})

window.addEventListener('load', function(){
    let Opcion= select.value;
    buscarDatos(Opcion,"","");
});