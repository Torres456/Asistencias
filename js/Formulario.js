const inputs = document.querySelectorAll('#Form input');
const Button__Option = document.getElementById('Button__Option-Send');

const contraseña = document.getElementById('Clave');
const contraseña2 = document.getElementById('Clave_2');


Btn_Error_cerrar.addEventListener('click', () => {
    document.getElementById('Alert_Send').classList.remove('Alert_Send-Active');
});


function Chech() {
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



        if (contraseña.value != contraseña2.value) {

            document.getElementById('Alert_Send_Title').innerHTML = "Las contraseñas no coinciden";
            document.getElementById('Alert_Send').classList.add('Alert_Send-Active');

        } else {
            Envio();
        }

    }

}

function Envio() {

    document.getElementById('Messaje_Send').classList.add('Active');
    cadena = "Matricula=" + $('#Matricula').val() +
        "&Nombre=" + $('#Nombre').val() +
        "&A_paterno=" + $('#Apellido_paterno').val() +
        "&A_materno=" + $('#Apellido_materno').val() +
        "&Usuario=" + $('#Usuario').val() +
        "&Contrasena=" + $('#Clave').val() +
        "&accion=" + 1;
        datos(cadena);


}


function datos(cadena) {

    $.ajax({
        type: "POST",
        url: "../BD/crear.php",
        data: cadena,

        success: function (r) {
            document.getElementById('Messaje_Send').classList.remove('Active');

            if (r == 202) {
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

















Button__Option.addEventListener('click', () => {
    document.getElementById('Alert_Send').classList.remove('Alert_Send-Active');
    Chech();


});