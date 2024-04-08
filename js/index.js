const Button__Salida = document.querySelectorAll('.Button_Move');
const Box_Carrucel = document.getElementById('Box_Carrucel');
const inputs = document.querySelectorAll('.Form__Input');
const buton1 = document.getElementById('Button__Entrada');
const buton2 = document.getElementById('Button__Salida');
const ErrorF = document.querySelectorAll('.Form__Input-Error');

const select = document.getElementById('Responsable');

let num = 1;
Button__Salida.forEach((Buttons) => {
    
    Buttons.addEventListener('click', (e) => {

        e.preventDefault();
        document.getElementById('Form_One').reset();
        document.getElementById('Form_Two').reset();
        campos.Matricula = false;
        campos.Equipo = false;
        campos.Observaciones = false;
        campos2.MatriculaS = false;

        ErrorF.forEach((campos) => {
            campos.classList.remove('Active');
            // campos.classList.style.border = "black";
        });

        let position = num
        let operation = position * -50
        Box_Carrucel.style.transform = `translateX(${operation}%)`
        if (num == 1) {
            num = 0;
        } else {
            num = 1;
        }
    });
});

const expresiones = {
    usuario: /^[a-zA-Z0-9\_\-]{4,18}$/,
    matricula: /^[a-zA-Z0-9\_\-]{4,10}$/,
    nombre: /^[a-zA-ZÀ-ÿ\s]{1,70}$/,
    equipo: /^\d{1,3}$/,
    mensaje: /^[a-zA-ZÀ-ÿ0-9\_\-\s]{1,300}$/,
};

const campos = {
    Matricula: false,
    Equipo: false,
    Observaciones: false,
    Responsable:false,
};

const campos2 = {
    MatriculaS: false
};

//Validación de contacto---
const ValidarCampo = (expresion, input, campo) => {
    if (expresion.test(input.value)) {
        document.getElementById(`Group__${campo}`).classList.remove('Formulario__Grupo-Incorrecto');
        document.querySelector(`#Group__${campo} .Form__Input-Error`).classList.remove('Active');
        campos[campo] = true;
    } else {
        document.getElementById(`Group__${campo}`).classList.add('Formulario__Grupo-Incorrecto');
        document.querySelector(`#Group__${campo} .Form__Input-Error`).classList.add('Active');
        campos[campo] = false;
    }
};

const ValidarCampo2 = (expresion, input, campo) => {
    if (expresion.test(input.value)) {
        document.getElementById(`Group__${campo}`).classList.remove('Formulario__Grupo-Incorrecto');
        document.querySelector(`#Group__${campo} .Form__Input-Error`).classList.remove('Active');
        campos[campo] = true;
        campos2[campo] = true;
    } else {
        document.getElementById(`Group__${campo}`).classList.add('Formulario__Grupo-Incorrecto');
        document.querySelector(`#Group__${campo} .Form__Input-Error`).classList.add('Active');
        campos[campo] = true;
        campos2[campo] = false;
    }
};

const validacionForm = (e) => {
    switch (e.target.name) {
        case "Matricula":
            ValidarCampo(expresiones.matricula, e.target, 'Matricula');
            break;
        case "Equipo":
            ValidarCampo(expresiones.equipo, e.target, 'Equipo');
            break;
        case "Observaciones":
            ValidarCampo(expresiones.mensaje, e.target, 'Observaciones');
            break;
        case "MatriculaS":
            ValidarCampo2(expresiones.matricula, e.target, 'MatriculaS');
            break;
    }
};

inputs.forEach((input) => {
    input.addEventListener('keyup', validacionForm);
    input.addEventListener('click', validacionForm);
});

Btn_Error_cerrar.addEventListener('click', () => {
    document.getElementById('Alert_Send').classList.remove('Alert_Send-Active');
});

select.addEventListener('change',()=>{
    if (select.value == "0") {
        campos.Responsable = false;
    } else { 
        campos.Responsable = true;
    }


});



buton1.addEventListener('click', (e) => {
    e.preventDefault();
    document.getElementById('Alert_Send').classList.remove('Alert_Send-Active');
    if (campos.Matricula && campos.Equipo && campos.Observaciones && campos.Responsable) {
        document.getElementById('Messaje_Send').classList.add('Active');
        document.getElementById('Messaje_Send').innerHTML = "Enviando...";
         asistenciaE();

    } else {
        document.getElementById('Alert_Send').style.backgroundColor = "red";
        document.getElementById('Alert_Send_Title').innerHTML = "Rellena el formulario correctamente";
        document.getElementById('Alert_Send').classList.add('Alert_Send-Active');
    }
});

buton2.addEventListener('click', (e) => {
    e.preventDefault();
    document.getElementById('Alert_Send').classList.remove('Alert_Send-Active');
    if (campos2.MatriculaS) {
        document.getElementById('Messaje_Send2').classList.add('Active');
        document.getElementById('Messaje_Send2').innerHTML = "Enviando...";
        asistenciaS();
    } else {
        document.getElementById('Alert_Send').style.backgroundColor = "red";
        document.getElementById('Alert_Send_Title').innerHTML = "Rellena el formulario correctamente";
        document.getElementById('Alert_Send').classList.add('Alert_Send-Active');
    }
});

//Asistencia entrada
const asistenciaE = () => {
    $.ajax({
        type: "POST",
        url: "BD/Asistencia.php",
        data: {
            Entrada: document.getElementById('txtClock').textContent,
            Fecha: document.getElementById('txtDate').textContent,
            Usuario: document.getElementById('Matricula').value,
            Recurso: document.getElementById('Equipo').value,
            Observaciones: document.getElementById('Observaciones').value,
            Responsable: select.value,
            Action: 1
        },
        success: function (r) {
            document.getElementById('Messaje_Send').classList.remove('Active');
            if (r == 2) {
                document.getElementById('Alert_Send_Title').innerHTML = "Este usuario no se encuentra registrado";
                document.getElementById('Alert_Send').classList.add('Alert_Send-Active');
                document.getElementById('Alert_Send').style.backgroundColor = "red";
            } else if (r == 3) {
                document.getElementById('Alert_Send_Title').innerHTML = "Ya tienes tu asistencia registrada";
                document.getElementById('Alert_Send').classList.add('Alert_Send-Active');
                document.getElementById('Alert_Send').style.backgroundColor = "gold";
            } else if (r == 200) {
                swal({
                    title: "Entrada registrada",
                    icon: "success",
                    button: "Salir",
                }).then(function () {
                    location.reload();
                });
                return false;
            } else {
                swal({
                    icon: 'error',
                    title: 'Oops...',
                    text: 'Tenemos un problema, intentalo más tarde.'
                });
                return false;
            }
        }
    });
}

// Asitencia salida

const asistenciaS = () => {
    $.ajax({
        type: "POST",
        url: "BD/Asistencia.php",
        data: {
            Usuario: document.getElementById('MatriculaS').value,
            Action: 2
        },
        success: function (r) {
            document.getElementById('Messaje_Send2').classList.remove('Active');
            if (r == 2) {
                document.getElementById('Alert_Send_Title').innerHTML = "Este usuario no se encuentra registrado";
                document.getElementById('Alert_Send').classList.add('Alert_Send-Active');
                document.getElementById('Alert_Send').style.backgroundColor = "red";
            } else if (r == 3) {
                document.getElementById('Alert_Send_Title').innerHTML = "No tienes asistencia de entrada";
                document.getElementById('Alert_Send').classList.add('Alert_Send-Active');
                document.getElementById('Alert_Send').style.backgroundColor = "red";
            } else if (r == 200) {
                swal({
                    title: "Salida registrada",
                    icon: "success",
                    button: "Salir",
                }).then(function () {
                    location.reload();
                });
                return false;
            } else {
                swal({
                    icon: 'error',
                    title: 'Oops...',
                    text: 'Tenemos un problema, intentalo más tarde.'
                });
                return false;
            }
        }
    });
}

window.addEventListener('load', function(){
    $('#onload').fadeOut();
    $('body').removeClass('hidden');
    
});