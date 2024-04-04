const inputs = document.querySelectorAll('#Form input');
const requeriments = document.querySelectorAll('.Requeriments__Shipment');

const Form__Input = document.querySelectorAll('.Form__Input');
const select = document.querySelectorAll('.Form__Select');
const Button__Send = document.getElementById('Button__Send');
const Btn_Error_cerrar = document.getElementById('Btn_Error_cerrar');

const Tipo = document.getElementById('Tipo');

const expresiones = {
    usuario: /^[a-zA-Z0-9\_\-]{4,18}$/,
    matricula: /^[a-zA-Z0-9\_\-]{4,10}$/,
    nombre: /^[a-zA-ZÀ-ÿ\s]{1,100}$/,
    password: /^.{4,12}$/,
    correo: /^[a-zA-Z0-9_.+-]+@[a-zA-Z0-9-]+\.[a-zA-Z0-9-.]+$/,
    telefono: /^\d{7,14}$/,
    edad: /^\d{1,4}$/,
    mensaje: /^[a-zA-ZÀ-ÿ0-9\_\-\s]{1,300}$/,
};

const campos = {
    Tipo: false,
    Matricula: false,
    Nombre: false,
    ApellidoP: false,
    ApellidoM: false,
    Edad: false,
    Genero: false,
    Carrera: false,
    Proyecto: false,
    Equipo: false,
    Observaciones: false,
    Responsable: false,
};

// Metods----->


// select-->
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

//Id-Generation-->
function generateUUID() {
    var d = new Date().getTime();
    var uuid = 'xxxyxyx'.replace(/[xy]/g, function (c) {
        var r = (d + Math.random() * 16) % 16 | 0;
        d = Math.floor(d / 16);
        return (c == 'x' ? r : (r & 0x3 | 0x8)).toString(16);
    });
    return uuid;
}

//Field-validation-->
const ValidarCampo = (expresion, input, campo) => {
    if (expresion.test(input.value)) {

        document.getElementById(`Chart__${campo}`).classList.add('Requeriments__Shipment-Active');

        document.getElementById(`Group__${campo}`).classList.remove('Formulario__Grupo-Incorrecto');

        document.querySelector(`#Group__${campo} .Form__Input-Error`).classList.remove('Active');

        campos[campo] = true;
    } else {
        document.getElementById(`Chart__${campo}`).classList.remove('Requeriments__Shipment-Active');

        document.querySelector(`#Group__${campo} .Form__Input-Error`).classList.add('Active');
        document.getElementById(`Group__${campo}`).classList.add('Formulario__Grupo-Incorrecto');
        campos[campo] = false;
    }
};

//Field-selection-->

requeriments.forEach((allpoint, i) => {
    requeriments[i].addEventListener('click', () => {
        Form__Input[i].focus();
    })
});

//Case-selecction-->

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
        case "Proyecto":
            ValidarCampo(expresiones.mensaje, e.target, 'Proyecto');
            break;
        case "Equipo":
            ValidarCampo(expresiones.edad, e.target, 'Equipo');
            break;
        case "Observaciones":
            ValidarCampo(expresiones.mensaje, e.target, 'Observaciones');
            break;
        case "Responsable":
            ValidarCampo(expresiones.nombre, e.target, 'Responsable');
            break;
    }
};
//Add-metods---->

//Inpúts-->
inputs.forEach((input) => {
    input.addEventListener('keyup', validacionForm);
    input.addEventListener('click', validacionForm);
});

//Select-->
select.forEach((selectI) => {
    selectI.addEventListener('change', validacionselect);

});



Tipo.addEventListener('change', () => {

    let select = Tipo.value;

    if (select == 'Externo') {
        let idRandom = generateUUID();
        document.getElementById('Matricula').value = idRandom;
        document.getElementById('Chart__Matricula').classList.add('Requeriments__Shipment-Active');
        document.getElementById('Chart__Tipo').classList.add('Requeriments__Shipment-Active');
        document.getElementById('Group__Matricula').classList.remove('Formulario__Grupo-Incorrecto');
        document.querySelector('#Group__Matricula .Form__Input-Error').classList.remove('Active');
        campos.Matricula = true;
        campos.Tipo = true;
    } else if (select == '0') {
        document.getElementById('Chart__Matricula').classList.remove('Requeriments__Shipment-Active');
        document.getElementById('Chart__Tipo').classList.remove('Requeriments__Shipment-Active');
        document.getElementById('Matricula').value = '';
        campos.Matricula = false;
        campos.Tipo = false;

    } else {
        document.getElementById('Chart__Tipo').classList.add('Requeriments__Shipment-Active');
        document.getElementById('Chart__Matricula').classList.remove('Requeriments__Shipment-Active');
        document.getElementById('Matricula').value = '';
        campos.Tipo = true;
        campos.Matricula = false;

    }

});

//Close-alert-button--->
Btn_Error_cerrar.addEventListener('click', () => {
    document.getElementById('Alert_Send').classList.remove('Alert_Send-Active');
});


//Video----->
var videoWidth = 320;
var videoHeight = 240;
var videoTag = document.getElementById('theVideo');
var canvasTag = document.getElementById('theCanvas');
videoTag.setAttribute('width', videoWidth);
videoTag.setAttribute('height', videoHeight);
canvasTag.setAttribute('width', videoWidth);
canvasTag.setAttribute('height', videoHeight);

window.onload = () => {
    navigator.mediaDevices.getUserMedia({
        audio: false,
        video: {
            width: videoWidth,
            height: videoHeight
        }
    }).then(stream => {
        videoTag.srcObject = stream;
    }).catch(e => {

        document.getElementById('errorTxt').innerHTML = 'ERROR: ' + e.toString();

    });

    var canvasContext = canvasTag.getContext('2d');



     //blob
     function dataURLtoBlob(dataurl) {
        var arr = dataurl.split(','), mime = arr[0].match(/:(.*?);/)[1],
            bstr = atob(arr[1]), n = bstr.length, u8arr = new Uint8Array(n);
        while (n--) {
            u8arr[n] = bstr.charCodeAt(n);
        }
        return new Blob([u8arr], { type: mime });
    }

    
    Button__Send.addEventListener("click", (e) => {

        document.getElementById('Alert_Send').classList.remove('Alert_Send-Active');
        e.preventDefault();

        if (campos.Tipo && campos.Matricula && campos.Nombre && campos.ApellidoP && campos.ApellidoM && campos.Edad && campos.Genero && campos.Carrera && campos.Proyecto && campos.Equipo && campos.Observaciones && campos.Responsable) {

            // canvasContext.drawImage(videoTag, 0, 0, videoWidth, videoHeight);
            document.getElementById('Messaje_Send').classList.add('Active');
            document.getElementById('Messaje_Send').innerHTML = "Enviando...";


            canvasContext.drawImage(videoTag, 0, 0, videoWidth, videoHeight);
            var link = document.createElement('a');
            link.href = canvasTag.toDataURL();
            var blob = dataURLtoBlob(canvasTag.toDataURL());

            Envio(blob);

        } else {
            document.getElementById('Alert_Send').style.backgroundColor = "red";
            document.getElementById('Alert_Send_Title').innerHTML = "Rellena el formulario correctamente";
            document.getElementById('Alert_Send').classList.add('Alert_Send-Active');
        }

    });
}

function Envio(image){

    $.ajax({
        type: "POST",
        url: "BD/Registro.php",
        data: {
            Tipo: document.getElementById('Tipo').value,
            Matricula: document.getElementById('Matricula').value,
            Nombre: document.getElementById('Nombre').value,
            ApellidoP: document.getElementById('ApellidoP').value,
            ApellidoM: document.getElementById('ApellidoM').value,
            Edad: document.getElementById('Edad').value,
            Genero: document.getElementById('Genero').value,
            Carrera: document.getElementById('Carrera').value,
            Proyecto: document.getElementById('Proyecto').value,
            Equipo: document.getElementById('Equipo').value,
            Observaciones: document.getElementById('Observaciones').value,
            Responsable: document.getElementById('Responsable').value,
            Action: 2
        },
        success: function (r) {
            document.getElementById('Messaje_Send').classList.remove('Active');
            if (r == 2) {

                document.getElementById('Alert_Send_Title').innerHTML = "Este usuario ya se encuentra registrado";
                document.getElementById('Alert_Send').classList.add('Alert_Send-Active');
                document.getElementById('Alert_Send').style.backgroundColor = "gold";
            } else if (r == 200) {
                Image(image);
            } else {
                swal({
                    icon: 'error',
                    title: 'Oops...',
                    text: 'Tenemos un problema, registrate más tarde.'
                });
                return false;
            }
        }
    });

}

function Image(image) {

    let matricula = document.getElementById('Matricula').value;
    var data = new FormData();
    data.append("capturedImage", image, matricula + "-Image.png");

    $.ajax({
        type: "POST",
        url: "BD/Envio_Image.php",
        data: data,
        processData: false,
        contentType: false,
        success: function (r) {
            if (r == 200) {
                swal({
                    title: "Usuario registrado correctamente",
                    icon: "success",
                    button: "Salir",
                }).then(function () {
                    location.reload();
                });
                return false;

            } else if (r == 300) {
                swal({
                    icon: 'error',
                    title: 'Oops...',
                    text: 'Tenemos un problema, registrate más tarde.'
                });
                return false;
            } else {
                swal({
                    icon: 'error',
                    title: 'Oops...',
                    text: 'Tenemos un problema, registrate más tarde.'
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




