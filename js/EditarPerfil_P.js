let Header__Title = document.getElementById('Header__Title');
let opcion = Header__Title.innerHTML;
const inputs = document.querySelectorAll('#Form input');
let send = document.getElementById('Button__Option-Send');
let atras = document.getElementById('Btn_Arrow');
let cancel = document.getElementById('Messaje_Cancel_Title');



atras.addEventListener('click', () => {
    window.history.back();
});

cancel.addEventListener('click', () => {
    window.history.back();
});


function Chech(option) {
    array = [];
    num = 0;
    inputs.forEach((input) => {
        if ($(input).val() == "") {
            array.push(input);
            num = 1;
        } else {
        }
    });

    if (num == 1) {
        document.getElementById('Alert_Send_Title').innerHTML = "Algunos campos están incompletos: ";
        for (var i = 0; i < array.length; i++) {
            let text1 = document.getElementById('Alert_Send_Title').textContent;
            let tex2 = array[i].name;
            let text3 = text1 + "-" + tex2;
            document.getElementById('Alert_Send_Title').innerHTML = text3;
        }
        document.getElementById('Alert_Send').classList.add('Alert_Send-Active');
    } else {
        document.getElementById('Messaje_Send').classList.add('Active');
        Envio(option);

    }

}


send.addEventListener('click', () => {

    if (opcion == 'Editar datos personales.') {
        Chech(1);
    } else if (opcion == 'Editar datos académicos.') {
        Chech(2);
    } else if (opcion == 'Editar datos de servicio.') {
        Chech(3);
    }else if (opcion == 'Editar contraseña.') {
        Chech(4);
    }

});


Btn_Error_cerrar.addEventListener('click', () => {
    document.getElementById('Alert_Send').classList.remove('Alert_Send-Active');
});


function Envio(option) {


    if (option == 1) {
        cadena = "Nombre=" + $('#Nombre').val() +
            "&A_paterno=" + $('#Apellido_paterno').val() +
            "&A_materno=" + $('#Apellido_materno').val() +
            "&Edad=" + $('#Edad').val() +
            "&Genero=" + $('#Genero').find('option:selected').text() +
            "&N_celular=" + $('#Numero_cel').val() +
            "&N_casa=" + $('#Numero_cas').val() +
            "&Matricula=" + $('#MatriculaP').val() +
            "&accion=" + 1;
            Actualizar(cadena);

    } else if (option == 2) {

       if($('#Matricula').val()!=$('#MatriculaP').val()){

        Swal.fire({
            title: "¿Actualizar la matricula?",
            text: "Esta acción no se puede rebertir",
            icon: "warning",
            showCancelButton: true,
            confirmButtonColor: "#3085d6",
            cancelButtonColor: "#d33",
            confirmButtonText: "Si, actualizar!"
        }).then((result) => {
            if (result.isConfirmed) {

                cadena = "TipoU=" + $('#TipoU').find('option:selected').text() +
                "&Carrera=" + $('#Carrera').find('option:selected').text() +
                "&Grupo=" + $('#Grupo').val() +
                "&Matricula=" + $('#Matricula').val() +
                "&MatriculaP=" + $('#MatriculaP').val() +
                "&accion=" + 2;
                Actualizar(cadena);
            }else{
                document.getElementById('Messaje_Send').classList.remove('Active');
                return false;
            }
        });

       }else{

        cadena = "TipoU=" + $('#TipoU').find('option:selected').text() +
            "&Carrera=" + $('#Carrera').find('option:selected').text() +
            "&Grupo=" + $('#Grupo').val() +
            "&Matricula=" + $('#Matricula').val() +
            "&MatriculaP=" + $('#MatriculaP').val() +
            "&accion=" + 2;

            Actualizar(cadena);
       }

        
    }else if(option == 3){
        cadena = "Servicio=" + $('#Servicio').find('option:selected').text() +
        "&Estatus=" + $('#Estatus').find('option:selected').text() +
        "&Fecha_I=" + $('#Fecha_I').val() +
        "&Fecha_T=" + $('#Fecha_T').val() +
        "&Proyecto=" + $('#Proyecto').val() +
        "&Responsable=" + $('#Responsable').val() +
        "&Matricula=" + $('#MatriculaP').val() +
        "&accion=" + 3;
        Actualizar(cadena);

    }else if (option == 4) {

        if ($('#password').val() != $('#Password2').val()) {
            document.getElementById('Alert_Send_Title').innerHTML = "Las contraseñas no coinciden";
            document.getElementById('Alert_Send').classList.add('Alert_Send-Active');
            document.getElementById('Messaje_Send').classList.remove('Active');

        } else {
            cadena = "Contraseña=" + $('#password').val() +
                "&Matricula=" + $('#MatriculaP').val() +
                "&accion=" + 4;
                Actualizar(cadena);
        }
    }


}

function Actualizar (cadena){
    $.ajax({
        type: "POST",
        url: "../BD/ActualizarP.php",
        data: cadena,

        success: function (r) {
            document.getElementById('Messaje_Send').classList.remove('Active');
            if (r == 2) {
                document.getElementById('Alert_Send_Title').innerHTML = "Usuario no encontrado";
                document.getElementById('Alert_Send').classList.add('Alert_Send-Active');
                document.getElementById('Alert_Send').style.backgroundColor = "gold";
                return false;
            } else if (r == 202) {

                document.getElementById('Alert_Send_Title').innerHTML = "La matricula ingresada ya se encuentra registrada";
                document.getElementById('Alert_Send').classList.add('Alert_Send-Active');
                document.getElementById('Alert_Send').style.backgroundColor = "gold";
                return false;
            } else if (r == 200) {

                Swal.fire({
                    title: "Usuario actualizado correctamente",
                    icon: "success",
                    button: "Salir",
                }).then(function () {
                    location.reload();
                });
                return false;
            } else if (r == 201) {
                Swal.fire({
                    title: "Usuario actualizado correctamente",
                    icon: "success",
                    button: "Salir",
                }).then(function () {
                    $(location).attr('href', 'Usuarios.php');

                });
                return false;
            } else {
                Swal.fire({
                    icon: 'error',
                    title: 'Oops...',
                    text: 'Tenemos un problema, regresa mas tarde.'
                });
                return false;
            }
        }
    });

}


