let button = document.getElementById('Button__Option-Two');
let nombre = document.getElementById('Nombre');
let A_paterno = document.getElementById('A_paterno');
let A_materno = document.getElementById('A_materno');
let Edad = document.getElementById('Edad');
let Genero = document.getElementById('Genero');
let N_celular = document.getElementById('N_celular');
let N_casa = document.getElementById('N_casa');
// Academics
let TipoU = document.getElementById('TipoU');
let Carrera = document.getElementById('Carrera');
let Matricula = document.getElementById('Matricula');
let Grupo = document.getElementById('Grupo');
let Servicio = document.getElementById('Servicio');

let Fecha_I = document.getElementById('Fecha_I');
let Fecha_T = document.getElementById('Fecha_T');
let Proyecto = document.getElementById('Proyecto');
let Responsable = document.getElementById('Responsable');
let Input__Password = document.getElementById('Input__Password');

var testData = !!document.getElementById("Btn_Password");
if(testData){

//Close-alert-button--->
Btn_Error_cerrar.addEventListener('click', () => {
    document.getElementById('Alert_Send').classList.remove('Alert_Send-Active');
});


let Btn_Password = document.getElementById('Btn_Password');
let Img_Password = document.getElementById('Btn_Password');


let numP = 0;


Btn_Password.addEventListener('click',()=>{
    if(numP==0){
        Img_Password.setAttribute("src","assets/images/visibility_on.png");
        Input__Password.setAttribute("type","text");
        numP = 1;
    }else{
        Img_Password.setAttribute("src","assets/images/visibility_off.png");
        Input__Password.setAttribute("type","password");
        numP = 0;
    }
});

var array = [];
let num = 0;

button.addEventListener('click', () => {
    array = [];
    num = 0;
    document.getElementById('Alert_Send').classList.remove('Alert_Send-Active');
    if (nombre.value === "") {
        array.push('Nombre');
        num = 1;
    }
    if (A_paterno.value === "") {
        array.push('Apellido paterno');
        num = 1;
    }
    if (A_materno.value === "") {
        array.push('Apellido materno');
        num = 1;
    }
    if (Edad.value === "") {
        array.push('Edad');
        num = 1;
    }
    if (N_celular.value === "") {
        array.push('Número de celular');
        num = 1;
    }
    if (N_casa.value === "") {
        array.push('Número de casa');
        num = 1;
    }
    if (Matricula.value === "") {
        array.push('Matricula');
        num = 1;
    }
    if (Grupo.value === "") {
        array.push('Grupo');
        num = 1;
    }
    if (Fecha_I.value === "") {
        array.push('Fecha de inicio');
        num = 1;
    }
    if (Fecha_T.value === "") {
        array.push('Fecha de termino');
        num = 1;
    }
    if (Proyecto.value === "") {
        array.push('Proyecto');
        num = 1;
    }
    if (Input__Password.value === "") {
        array.push('Contraseña');
        num = 1;
    }
    if (num == 1) {
        document.getElementById('Alert_Send_Title').innerHTML = "Algunos campos están incompletos: ";
        for (var i = 0; i < array.length; i++) {
            let text1 = document.getElementById('Alert_Send_Title').textContent;
            let tex2 = array[i];
            let text3 = text1 + tex2 + "-";
            document.getElementById('Alert_Send_Title').innerHTML = text3;
        }
        document.getElementById('Alert_Send').classList.add('Alert_Send-Active');
    } else {
        document.getElementById('Messaje_Send').classList.add('Active');
        Envio();

    }

});


function Envio() {
    $.ajax({
        type: "POST",
        url: "BD/Actualizar.php",
        data: {
            Nombre: document.getElementById('Nombre').value,
            A_paterno: document.getElementById('A_paterno').value,
            A_materno: document.getElementById('A_materno').value,
            Edad: document.getElementById('Edad').value,
            Genero: document.getElementById('Genero').value,
            N_celular: document.getElementById('N_celular').value,
            N_casa: document.getElementById('N_casa').value,
            TipoU: document.getElementById('TipoU').value,
            Carrera: document.getElementById('Carrera').value,
            Matricula: document.getElementById('Matricula').value,
            Grupo: document.getElementById('Grupo').value,
            Servicio: document.getElementById('Servicio').value,
            Fecha_I: document.getElementById('Fecha_I').value,
            Fecha_T: document.getElementById('Fecha_T').value,
            Proyecto: document.getElementById('Proyecto').value,
            Responsable: document.getElementById('Responsable').value,
            user:document.getElementById('None').value,
            Password:document.getElementById('Input__Password').value
        },
        success: function (r) {
            document.getElementById('Messaje_Send').classList.remove('Active');
            if (r == 2) {
                document.getElementById('Alert_Send_Title').innerHTML = "Usuario no encontrado";
                document.getElementById('Alert_Send').classList.add('Alert_Send-Active');
                document.getElementById('Alert_Send').style.backgroundColor = "gold";
            }else if (r == 202) {

                document.getElementById('Alert_Send_Title').innerHTML = "La matricula ingresada ya se encuentra registrada";
                document.getElementById('Alert_Send').classList.add('Alert_Send-Active');
                document.getElementById('Alert_Send').style.backgroundColor = "gold";
                return false;
            } else if (r == 200) {

                swal({
                    title: "Usuario actualizado correctamente",
                    icon: "success",
                    button: "Salir",
                }).then(function () {
                    location.reload();
                });
                return false;
            }else if(r == 201){
                swal({
                    title: "Usuario actualizado correctamente",
                    icon: "success",
                    button: "Salir",
                }).then(function () {
                    Cerrar();
                 
                });
                return false;
            } else {
                swal({
                    icon: 'error',
                    title: 'Oops...',
                    text: 'Tenemos un problema, regresa mas tarde.'
                });
                return false;
            }
        }
    });
}

function Cerrar() {
    $.ajax({
        type: "POST",
        url: "BD/CerrarSecion.php",
        data: {
            Action:1
        },
        success: function (r) {
            if (r == 200) {
                $(location).attr('href', 'index.php');
            }else {
                swal({
                    icon: 'error',
                    title: 'Oops...',
                    text: 'Tenemos un problema.'
                });
                return false;
            }
        }
    });
}











}else{


}


window.addEventListener('load', function () {
    $('#onload').fadeOut();
    $('body').removeClass('hidden');

});





