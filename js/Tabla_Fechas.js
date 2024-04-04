let usuario = document.getElementById('Label_Matricula');
let fecha1 = document.getElementById('DateA');
let fecha2 = document.getElementById('DateB');
let select = document.getElementById('Asistencia');

select.addEventListener('change', () => {
    let fechaA = fecha1.value;
    let fechaB = fecha2.value;


    let user = usuario.innerHTML;
    let tipo = select.value;

    if (fechaA.length == 0 && fechaB.length == 0) {
        buscarDatos(tipo, user);

    } else if (fechaA.length !== 0 && fechaB.length == 0) {
        buscarDatos(tipo, user, fechaA);

    } else if (fechaA.length !== 0 && fechaB.length !== 0) {

        buscarDatos(tipo, user, fechaA, fechaB);
    }

});


fecha1.addEventListener('change', () => {
    let fechaA = fecha1.value;
    let tipo = select.value;
    let fechaB = fecha2.value;
    let user = usuario.innerHTML;

    if (fechaB.length == 0) {
        buscarDatos(tipo, user, fechaA);
    } else if (fechaB.length !== 0) {
        buscarDatos(tipo, user, fechaA, fechaB);
    }
    // buscarDatos(tipo,user);
});

fecha2.addEventListener('change', () => {

    document.getElementById('Alert_Send').classList.remove('Alert_Send-Active');
    let fechaA = fecha1.value;
    let tipo = select.value;
    let fechaB = fecha2.value;
    let user = usuario.innerHTML;

    if (fechaA.length == 0) {
        document.getElementById('Alert_Send_Title').innerHTML = "Selecciona una fecha de inicio";
        document.getElementById('Alert_Send').classList.add('Alert_Send-Active');
        document.getElementById('Alert_Send').style.backgroundColor = "gold";
        fecha2.value = "";

    } else if (fechaA.length !== 0) {
        buscarDatos(tipo, user, fechaA, fechaB);
    }
    // buscarDatos(tipo,user);
});

function buscarDatos(tipo, usuario, fechaA, fechaB) {
    $.ajax({
        url: '../BD/Carga_fechas.php',
        type: 'POST',
        dataType: 'html',
        cache: 'none',
        data: {
            User: usuario,
            FechaA: fechaA,
            FechaB: fechaB,
            Tipo: tipo
        },
    })
        .done(function (respuesta) {
            $("#DatosF").html(respuesta);
        })
        .fail(function () {
            console.log("error");
        })
}

window.addEventListener('load', function () {
    let tipo = select.value;
    let user = usuario.innerHTML;
    buscarDatos("", user);
    buscarSanciones(user);
});


function buscarSanciones(usuario, fechaA, fechaB) {
    $.ajax({
        url: '../BD/CargaSanciones.php',
        type: 'POST',
        dataType: 'html',
        cache: 'none',
        data: {
            User: usuario,
            FechaA: fechaA,
            FechaB: fechaB
        },
    })
        .done(function (respuesta) {
            $("#DatosS").html(respuesta);
        })
        .fail(function () {
            console.log("error");
        })
}