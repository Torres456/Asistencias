const inputs = document.querySelectorAll('#Form input');
const requeriments = document.querySelectorAll('.Requeriments__Shipment');
const Form__Input = document.querySelectorAll('.Form__Input');

const Form__Date = document.querySelectorAll('.Form__Date');
const select = document.querySelectorAll('.Form__Select');

const Button__Send = document.getElementById('Button__Send');
const Btn_Error_cerrar = document.getElementById('Btn_Error_cerrar');

//select---->
const sexo = document.getElementById('Sexo');
const Responsable = document.getElementById('Responsable');
const tipoS = document.getElementById('TipoU');


document.getElementById('Chart__TipoU').classList.add('Requeriments__Shipment-Active');

Btn_Error_cerrar.addEventListener('click', () => {
    document.getElementById('Alert_Send').classList.remove('Alert_Send-Active');

});

//Generate--Id:
function generateUUID() {
    var d = new Date().getTime();
    var uuid = 'yxxyxyx'.replace(/[xy]/g, function (c) {
        var r = (d + Math.random() * 16) % 16 | 0;
        d = Math.floor(d / 16);
        return (c == 'x' ? r : (r & 0x3 | 0x8)).toString(16);
    });
    return uuid;
}

//Expreciones---
const expresiones = {
    usuario: /^[a-zA-Z0-9\_\-\s]{2,18}$/, // Letras, numeros, guion y guion_bajo
    matricula: /^[a-zA-Z0-9\_\-]{4,10}$/, // Letras, numeros, guion y guion_bajo
    nombre: /^[a-zA-ZÀ-ÿ\s]{1,100}$/, // Letras y espacios, pueden llevar acentos.
    password: /^.{4,12}$/, // 4 a 12 digitos.
    correo: /^[a-zA-Z0-9_.+-]+@[a-zA-Z0-9-]+\.[a-zA-Z0-9-.]+$/,
    telefono: /^\d{7,14}$/, // 7 a 14 numeros.
    edad: /^\d{1,3}$/, // 7 a 14 numeros.
    mensaje: /^[a-zA-ZÀ-ÿ0-9\_\-\s]{1,600}$/, // Letras, numeros, guion y guion_bajo pueden llevar acentos.
};

//Tipo--us
const campos = {
    TipoU: true,
    Matricula: false,
    Contraseña: false,
    Contraseña_2: false,
    Grupo: false,
    Carrera: false,
    Servicio: false,
    Nombre: false,
    ApellidoP: false,
    ApellidoM: false,
    Edad: false,
    Genero: false,
    No_Celular: false,
    No_Casa: false,
    FechaI: false,
    FechaT: false,
    Horas: false,
    Responsable: false,
    Proyecto: false
};


// select--tipo
tipoS.addEventListener('change', () => {
    let valorOption = tipoS.value;
    // alert(valorOption);
    if (valorOption == 'Alumno') {
        document.getElementById('Matricula').value = '';
        document.getElementById('Grupo').value = '';
        campos.Matricula = false;
        campos.Grupo = false;
        document.getElementById('Chart__Matricula').classList.remove('Requeriments__Shipment-Active');
        document.getElementById('Chart__Grupo').classList.remove('Requeriments__Shipment-Active');

        document.getElementById('Matricula').disabled = false;
        document.getElementById('Grupo').disabled = false;

    } else if (valorOption == 'Alumno_externo') {
        const idRandom = generateUUID();
        document.getElementById('Matricula').value = idRandom;
        document.getElementById('Matricula').setAttribute("disabled", "");
        document.getElementById('Grupo').value = 'Sin grupo';
        document.getElementById('Grupo').setAttribute("disabled", "");
        document.getElementById('Chart__Matricula').classList.add('Requeriments__Shipment-Active');
        document.getElementById('Chart__Grupo').classList.add('Requeriments__Shipment-Active');

        document.getElementById('Group__Matricula').classList.remove('Formulario__Grupo-Incorrecto');
        document.querySelector('#Group__Matricula .Form__Input-error').classList.remove('Active');
        document.getElementById('Group__Grupo').classList.remove('Formulario__Grupo-Incorrecto');
        document.querySelector('#Group__Grupo .Form__Input-error').classList.remove('Active');
        campos.Matricula = true;
        campos.Grupo = true;



    } else if (valorOption == 'Seleccione') {
        campos.Matricula = false;
        campos.Grupo = false;
        document.getElementById('Matricula').disabled = false;
        document.getElementById('Grupo').disabled = false;
    }
});

//Select---
const validacionselect = (e) => {
    let select = e.target.name;

    if (document.getElementById(`${select}`).value == "0") {
        document.getElementById(`Chart__${select}`).classList.remove('Requeriments__Shipment-Active');
        campos[select] = false;

    } else {
        document.getElementById(`Chart__${select}`).classList.add('Requeriments__Shipment-Active');
        campos[select] = true;
    }
};


//fecha----
const validaciondate = (e) => {
    let fetch = e.target.name;
    if (document.getElementById(`${fetch}`).value.length == 0) {

        document.getElementById(`Chart__${fetch}`).classList.remove('Requeriments__Shipment-Active');
        campos[fetch] = false;

    } else {
        document.getElementById(`Chart__${fetch}`).classList.add('Requeriments__Shipment-Active');
        campos[fetch] = true;
    }
};

Form__Date.forEach((date) => {
    date.addEventListener('change', validaciondate);

});

select.forEach((selectI) => {
    selectI.addEventListener('change', validacionselect);

});

//Inputs--->
const ValidarCampo = (expresion, input, campo) => {
    if (expresion.test(input.value)) {
        document.getElementById(`Chart__${campo}`).classList.add('Requeriments__Shipment-Active');
        document.getElementById(`Group__${campo}`).classList.remove('Formulario__Grupo-Incorrecto');
        document.querySelector(`#Group__${campo} .Form__Input-error`).classList.remove('Active');
        campos[campo] = true;
    } else {
        document.getElementById(`Chart__${campo}`).classList.remove('Requeriments__Shipment-Active');
        document.querySelector(`#Group__${campo} .Form__Input-error`).classList.add('Active');
        document.getElementById(`Group__${campo}`).classList.add('Formulario__Grupo-Incorrecto');
        campos[campo] = false;
    }
};

requeriments.forEach((allpoint, i) => {
    requeriments[i].addEventListener('click', () => {
        Form__Input[i].focus();
    })
});

const validacionForm = (e) => {
    Form__Input.forEach((allpoint, i) => {
        Form__Input[i].classList.remove('Form__Input-activo')
    })
    switch (e.target.name) {
        case "Matricula":
            ValidarCampo(expresiones.matricula, e.target, 'Matricula');
            break;
        case "Nombre":
            ValidarCampo(expresiones.nombre, e.target, 'Nombre');
            break;
        case "ApellidoP":
            ValidarCampo(expresiones.nombre, e.target, 'ApellidoP');
            break;
        case "ApellidoM":
            ValidarCampo(expresiones.nombre, e.target, 'ApellidoM');
            break;
        case "Edad":
            ValidarCampo(expresiones.edad, e.target, 'Edad');
            break;
        case "No_Celular":
            ValidarCampo(expresiones.telefono, e.target, 'No_Celular');
            break;
        case "No_Casa":
            ValidarCampo(expresiones.telefono, e.target, 'No_Casa');
            break;
        case "Horas":
            ValidarCampo(expresiones.edad, e.target, 'Horas');
            break;
        case "Proyecto":
            ValidarCampo(expresiones.mensaje, e.target, 'Proyecto');
            break;
        case "Grupo":
            ValidarCampo(expresiones.usuario, e.target, 'Grupo');
            break;
        case "Contraseña":
            ValidarCampo(expresiones.password, e.target, 'Contraseña');
            break;
        case "Contraseña_2":
            ValidarCampo(expresiones.password, e.target, 'Contraseña_2');
            break;
    }
};

inputs.forEach((input) => {
    input.addEventListener('keyup', validacionForm);
    input.addEventListener('click', validacionForm);
});


//Button--send----
Button__Send.addEventListener('click', (e) => {
    document.getElementById('Alert_Send').classList.remove('Alert_Send-Active');
    e.preventDefault();
    if (campos.TipoU && campos.Matricula && campos.Contraseña && campos.Contraseña_2 && campos.Carrera && campos.Grupo && campos.Servicio && campos.Nombre && campos.ApellidoP && campos.ApellidoM && campos.Edad && campos.Genero && campos.No_Celular && campos.No_Casa && campos.FechaI && campos.FechaT && campos.Horas && campos.Responsable && campos.Proyecto) {

        let contraseña1 = document.getElementById('Contraseña').value;
        let contraseña2 = document.getElementById('Contraseña_2').value;

        if (contraseña1 != contraseña2) {
            document.getElementById('Alert_Send').style.backgroundColor = "red";
            document.getElementById('Alert_Send_Title').innerHTML = "Las contraseñas no coinciden";
            document.getElementById('Alert_Send').classList.add('Alert_Send-Active');

        } else {

            document.getElementById('Messaje_Send').classList.add('Active');
            document.getElementById('Messaje_Send').innerHTML = "Enviando...";
            send();
        }

    } else {
        document.getElementById('Alert_Send').style.backgroundColor = "red";
        document.getElementById('Alert_Send_Title').innerHTML = "Rellena el formulario correctamente";
        document.getElementById('Alert_Send').classList.add('Alert_Send-Active');
    }
});


const send = () => {
    $.ajax({
        type: "POST",
        url: "BD/Registro.php?see=1.2",
        data: {
            Matricula: document.getElementById('Matricula').value,
            Contraseña: document.getElementById('Contraseña').value,
            Carrera: document.getElementById('Carrera').value,
            Grupo: document.getElementById('Grupo').value,
            Servicio: document.getElementById('Servicio').value,
            Tipo: document.getElementById('TipoU').value,
            Nombre: document.getElementById('Nombre').value,
            ApellidoP: document.getElementById('ApellidoP').value,
            ApellidoM: document.getElementById('ApellidoM').value,
            Edad: document.getElementById('Edad').value,
            Genero: document.getElementById('Genero').value,
            Numero_cel: document.getElementById('No_Celular').value,
            Numero_cas: document.getElementById('No_Casa').value,
            FechaI: document.getElementById('FechaI').value,
            FechaT: document.getElementById('FechaT').value,
            Horas: document.getElementById('Horas').value,
            Responsable: document.getElementById('Responsable').value,
            Proyecto: document.getElementById('Proyecto').value,
            Action: 1
        },
        success: function (r) {
            document.getElementById('Messaje_Send').classList.remove('Active');
            if (r == 2) {
                document.getElementById('Alert_Send_Title').innerHTML = "Este usuario ya se encuentra registrado";
                document.getElementById('Alert_Send').classList.add('Alert_Send-Active');
                document.getElementById('Alert_Send').style.backgroundColor = "gold";
            } else if (r == 200) {
                Swal.fire({
                    title: "Usuario registrado correctamente",
                    icon: "success",
                    button: "Salir",
                }).then(function () {
                    location.reload();
                });
                return false;
            } else {
                Swal.fire({
                    icon: 'error',
                    title: 'Oops...',
                    text: 'Tenemos un problema, registrate más tarde.'
                });
                return false;
            }
        }
    });
}
window.addEventListener('load', function () {
    $('#onload').fadeOut();
    $('body').removeClass('hidden');

});