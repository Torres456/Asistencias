// const search = document.getElementById('Usuario');
let select = document.getElementById('Servicio');
let select2 = document.getElementById('Alumno');
let select3 = document.getElementById('Estatus');

select.addEventListener('change', () => {
    let valorOption = select.value;
    let valorOption2 = select2.value;
    let valorOption3 = select3.value;
    document.getElementById('Consulta').value = '';

    if (valorOption == '0') {
        buscarDatos(0, valorOption2, valorOption3);

    } else if (valorOption == '1') {
        buscarDatos(1, valorOption2, valorOption3);

    } else if (valorOption == '2') {
        buscarDatos(2, valorOption2, valorOption3);
    }
});


select2.addEventListener('change', () => {
    let valorOption = select.value;
    let valorOption2 = select2.value;
    let valorOption3 = select3.value;

    document.getElementById('Consulta').value = '';

    buscarDatos(valorOption, valorOption2, valorOption3);
});

select3.addEventListener('change', () => {
    let valorOption = select.value;
    let valorOption2 = select2.value;
    let valorOption3 = select3.value;
    document.getElementById('Consulta').value = '';
    buscarDatos(valorOption, valorOption2, valorOption3);
});


let Opcion = select.value;
let Opcion2 = select2.value;
let Opcion3 = select3.value;

$(buscarDatos(Opcion, Opcion2, Opcion3));

function buscarDatos(accion, tipo, estatus, consulta) {
    $.ajax({
        url: '../BD/cargarPersonal.php',
        type: 'POST',
        dataType: 'html',
        cache: 'none',
        data: {
            consulta: consulta,
            Accion: accion,
            Tipo: tipo,
            Estatus: estatus
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
    let Opcion = select.value;
    let Opcion2 = select2.value;
    let Opcion3 = select3.value;

    var valor = $(this).val();
    if (valor != "") {
        buscarDatos(Opcion, Opcion2, Opcion3, valor);
    } else {
        buscarDatos(Opcion, Opcion2, Opcion3);
    }
})

window.addEventListener('load', function () {
    let Opcion = select.value;
    let Opcion2 = select2.value;
    let Opcion3 = select3.value;
    buscarDatos(Opcion, Opcion2, Opcion3);
});