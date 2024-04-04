const Btn_Error_cerrar = document.getElementById('Btn_Error_cerrarA');
const inputF = document.getElementById('file-5');

let Btn_Password = document.getElementById('Btn_Password');
let Img_Password = document.getElementById('Btn_Password');
let Input__Password = document.getElementById('Input__Password');

let Button__Delete = document.getElementById('Button__Delete');
let Button__Option_Two = document.getElementById('Button__Option_Two');


let Button__Option_One = document.getElementById('Button__Option_One');

let selectI = document.getElementById('TipoI');

selectI.addEventListener('change', (e) => {

    let select = selectI.value;
    if (select == "Fecha") {
        document.getElementById('SelectC').style.display = "none";
        document.getElementById('SelectB').style.display = "none";
        document.getElementById('SelectA').style.display = "Block";

        document.getElementById('SelectAF').reset();


    } else if (select == "HorasFecha") {
        document.getElementById('SelectC').style.display = "none";
        document.getElementById('SelectA').style.display = "none";
        document.getElementById('SelectB').style.display = "Block";
        document.getElementById('SelectBF').reset();

    } else if (select == "Horas") {
        document.getElementById('SelectA').style.display = "none";
        document.getElementById('SelectB').style.display = "none";
        document.getElementById('SelectC').style.display = "Block";
        document.getElementById('SelectCF').reset();

    }

});





Button__Option_One.addEventListener('click', () => {
    $(location).attr('href', 'Usuarios.php');
});

Button__Option_Two.addEventListener('click', () => {

    document.getElementById('Box__Items').classList.add('Display');
    Swal.fire({
        title: "¿Deseas cerrar tu seción?",
        text: "Tu sesión se cerrara",
        icon: "warning",
        showCancelButton: true,
        confirmButtonColor: "#3085d6",
        cancelButtonColor: "#d33",
        cancelButtonText: "Cancelar",
        confirmButtonText: "Si, salir!"
    }).then((result) => {
        if (result.isConfirmed) {
            cerrar();
        } else {
            document.getElementById('Box__Items').classList.remove('Display');

        }
    });
});


function cerrar() {
    $.ajax({
        type: "POST",
        url: "../BD/CerrarSecion.php",
        data: {
            option: 2
        },
        success: function (r) {
            if (r == 200) {
                $(location).attr('href', '../index.php');
            } else {
                Swal.fire({
                    icon: 'error',
                    title: 'Oops...',
                    text: 'No pudimos cerrar tu sesión.'
                }).then(function () {
                    location.reload();
                });
                return false;
            }
        }
    });
}

var testData = !!document.getElementById("Input__Password");
if (testData) {

    let num = 0;
    Input__Password.setAttribute("disabled", "");

    Btn_Password.addEventListener('click', () => {

        if (num == 0) {
            Img_Password.setAttribute("src", "../assets/images/visibility_on.png");
            Input__Password.setAttribute("type", "text");
            num = 1;
        } else {
            Img_Password.setAttribute("src", "../assets/images/visibility_off.png");
            Input__Password.setAttribute("type", "password");
            num = 0;
        }

    });
    // Botton close

    Btn_Error_cerrar.addEventListener('click', () => {
        document.getElementById('Alert_Send').classList.remove('Alert_Send-Active');
    });

    //Star_file
    ; (function (document, window, index) {
        var inputs = document.querySelectorAll('.inputfile');
        Array.prototype.forEach.call(inputs, function (input) {
            var label = input.nextElementSibling,
                labelVal = label.innerHTML;

            input.addEventListener('change', function (e) {
                var fileName = '';
                if (this.files && this.files.length > 1)
                    fileName = (this.getAttribute('data-multiple-caption') || '').replace('{count}', this.files.length);
                else
                    fileName = e.target.value.split('\\').pop();

                if (fileName)
                    label.querySelector('span').innerHTML = fileName;
                else
                    label.innerHTML = labelVal;
            });
        });
    }(document, window, 0));

    //Tamaño de archivo

    const maxSize = 3;

    inputF.addEventListener("change", function () {
        const tamaño = (this.files[0].size / 1024 / 1024).toFixed(2);
        document.getElementById('Alert_Send').classList.remove('Alert_Send-Active');
        if (tamaño > maxSize) {
            document.getElementById('Alert_Send').style.backgroundColor = "gold";
            document.getElementById('Alert_Send_Title').innerHTML = `El tamaño máximo es ${maxSize} MB`;
            document.getElementById('Alert_Send').classList.add('Alert_Send-Active');

            document.getElementById("FormFile").reset();
            document.getElementById('span').innerHTML = "Seleccionar archivo";
        } else {
            let filename = inputF.value;
            var extension = filename.replace(/^.*\./, '');

            if (extension == filename) {

                extension = '';
            } else {
                extension = extension.toLowerCase();
                if (extension != "pdf" && extension != 'png' && extension != 'jpeg' && extension != 'jpg' && extension != 'txt' && extension != 'doc' && extension != 'docx') {

                    document.getElementById('Alert_Send').style.backgroundColor = "gold";
                    document.getElementById('Alert_Send_Title').innerHTML = "Solo se aceptan documentos con formato= pdf, png, jpeg, jpg, txt, doc, docx ";


                    document.getElementById('Alert_Send').classList.add('Alert_Send-Active');
                    document.getElementById("FormFile").reset();
                    document.getElementById('span').innerHTML = "Seleccionar archivo";

                } else {

                }
            }

        }
    });

    //SendFila
    $(document).ready(function () {
        // Método para insertar los datos
        $("#FormFile").submit(function (event) {
            document.getElementById('Alert_Send').classList.remove('Alert_Send-Active');
            event.preventDefault();
            const archivosParaSubir = inputF.files;
            if (archivosParaSubir.length <= 0) {
                document.getElementById('Alert_Send').style.backgroundColor = "red";
                document.getElementById('Alert_Send_Title').innerHTML = "Selecciona un archivo para subir";
                document.getElementById('Alert_Send').classList.add('Alert_Send-Active');
            } else {
                var formData = new FormData($(this)[0]);
                $.ajax({
                    url: '../BD/Envio_Documento.php',
                    type: 'POST',
                    data: formData,
                    cache: false,
                    contentType: false,
                    processData: false,
                    success: function (r) {
                        if (r == 3) {
                            document.getElementById('Alert_Send_Title').innerHTML = "Este documento ya se encuentra registrado";
                            document.getElementById('Alert_Send').classList.add('Alert_Send-Active');
                            document.getElementById('Alert_Send').style.backgroundColor = "gold";
                        } else if (r == 200) {
                            Swal.fire({
                                title: "Archivo registrado",
                                icon: "success",
                                button: "Salir",
                            }).then(function () {
                                location.reload();
                            });
                            return false;
                        } else if (r == 201) {
                        } else {
                            Swal.fire({
                                icon: 'error',
                                title: 'Oops...',
                                text: 'Tenemos un problema,.'
                            });
                            return false;
                        }
                    }
                });
            }
        });
    });

    // Eliminar usuario

    Button__Delete.addEventListener('click', () => {
        let user = document.getElementById('Label_Matricula').innerHTML;
        Swal.fire({
            title: "¿Deseas eliminar este perfil?",
            text: "Esta acción no se puede revertir",
            icon: "warning",
            showCancelButton: true,
            confirmButtonColor: "#3085d6",
            cancelButtonColor: "#d33",
            confirmButtonText: "Si, eliminar!"
        }).then((result) => {
            if (result.isConfirmed) {
                document.getElementById('Messaje_Send').classList.add('Active');
                Eliminar(user);

            }
        });


    });


    let Button__Time = document.getElementById('Button__Time');
    let Button__TimeB = document.getElementById('Button__TimeB');

    Button__Time.addEventListener('click', () => {
        document.getElementById('Alert_Send').classList.remove('Alert_Send-Active');
        let user = document.getElementById('Label_Matricula').innerHTML;

        let select = selectI.value;
        if (select == "Fecha") {
            let InputA = document.getElementById('HorasA');
            let InputB = document.getElementById('MinutosA');
            let FechaA = document.getElementById('FechaA');

            if (FechaA.value === "") {
                document.getElementById('Alert_Send').style.backgroundColor = "Red";
                document.getElementById('Alert_Send_Title').innerHTML = "Coloca una fecha";
                document.getElementById('Alert_Send').classList.add('Alert_Send-Active');


            } else if (InputA.value === "") {
                document.getElementById('Alert_Send').style.backgroundColor = "Red";
                document.getElementById('Alert_Send_Title').innerHTML = "Coloca una hora";
                document.getElementById('Alert_Send').classList.add('Alert_Send-Active');

            } else {
                document.getElementById('Messaje_Send2').classList.add('Active');

                let fecha = FechaA.value;
                let puntos = ":";
                if (InputB.value === "") {
                    let time = InputA.value + puntos + "00";
                    Horas(time, user, 2, fecha);
                } else {
                    let time = InputA.value + puntos + InputB.value;
                    Horas(time, user, 2,fecha);
                }




            }

        } else if (select == "HorasFecha") {




            let FechaA = document.getElementById('FechaB');

            let HoraB = document.getElementById('HoraB');
            let HoraB2 = document.getElementById('HoraB2');

            let MinutoB = document.getElementById('MinutoB');
            let MinutosB2 = document.getElementById('MinutosB2');

            let TipoB = document.getElementById('TipoB');
            let TipoB2 = document.getElementById('TipoB2');

            
        


            if (FechaA.value === "") {
                document.getElementById('Alert_Send').style.backgroundColor = "Red";
                document.getElementById('Alert_Send_Title').innerHTML = "Coloca una fecha";
                document.getElementById('Alert_Send').classList.add('Alert_Send-Active');

            }else if (HoraB.value === "") {
                document.getElementById('Alert_Send').style.backgroundColor = "Red";
                document.getElementById('Alert_Send_Title').innerHTML = "Coloca una hora de entrada";
                document.getElementById('Alert_Send').classList.add('Alert_Send-Active');

            }else if (HoraB2.value === "") {
                document.getElementById('Alert_Send').style.backgroundColor = "Red";
                document.getElementById('Alert_Send_Title').innerHTML = "Coloca una hora de salida";
                document.getElementById('Alert_Send').classList.add('Alert_Send-Active');
            }else{

                document.getElementById('Messaje_Send2').classList.add('Active');
                let fecha = FechaA.value;
                if (MinutoB.value === "" && MinutosB2.value === ""){

                    let entrada= HoraB.value +":"+"00"+":00"+" "+TipoB.value;
                    let salida= HoraB2.value +":"+"00"+":00"+" "+TipoB2.value;
                    Horas("", user, 3, fecha,entrada,salida);
                }else if(MinutoB.value != "" && MinutosB2.value === ""){
                    let entrada= HoraB.value +":"+MinutoB.value+":00"+" "+TipoB.value;
                    let salida= HoraB2.value +":"+"00"+":00"+" "+TipoB2.value;
                    Horas("", user, 3, fecha,entrada,salida);
                }else if(MinutoB.value === "" && MinutosB2.value != ""){
                    let entrada= HoraB.value +":"+"00"+":00"+" "+TipoB.value;
                    let salida= HoraB2.value +":"+MinutosB2.value+":00"+" "+TipoB2.value;
                    Horas("", user, 3, fecha,entrada,salida);
                }else if(MinutoB.value != "" && MinutosB2.value != ""){

                    let entrada= HoraB.value +":"+MinutoB.value+":00"+" "+TipoB.value;
                    let salida= HoraB2.value +":"+MinutosB2.value+":00"+" "+TipoB2.value;
                    Horas("", user, 3, fecha,entrada,salida);
                }

            }



        } else if (select == "Horas") {

            let InputA = document.getElementById('HorasC');
            let InputB = document.getElementById('MinutosC');

            if (InputA.value === "") {

                document.getElementById('Alert_Send').style.backgroundColor = "Red";
                document.getElementById('Alert_Send_Title').innerHTML = "Coloca una hora";
                document.getElementById('Alert_Send').classList.add('Alert_Send-Active');
            } else {
                document.getElementById('Messaje_Send2').classList.add('Active');
                let puntos = ":";
                if (InputB.value === "") {
                    let time = InputA.value + puntos + "00";
                    Horas(time, user, 1);
                } else {
                    let time = InputA.value + puntos + InputB.value;
                    Horas(time, user, 1);
                }
            }

        }
    });

    //Eliminar

    Button__TimeB.addEventListener('click', () => {
        let user = document.getElementById('Label_Matricula').innerHTML;
        let InputA = document.getElementById('HorasT');
        let InputB = document.getElementById('MinutosT');
        let FechaT = document.getElementById('DateT');
        let ObservacionT = document.getElementById('ObservacionT');





        document.getElementById('Alert_Send').classList.remove('Alert_Send-Active');


        if (InputA.value === "") {
            document.getElementById('Alert_Send').style.backgroundColor = "Red";
            document.getElementById('Alert_Send_Title').innerHTML = "Coloca una hora";
            document.getElementById('Alert_Send').classList.add('Alert_Send-Active');

        } else if(FechaT.value === ""){

            document.getElementById('Alert_Send').style.backgroundColor = "Red";
            document.getElementById('Alert_Send_Title').innerHTML = "Coloca una fecha";
            document.getElementById('Alert_Send').classList.add('Alert_Send-Active');

        }else {
            document.getElementById('Messaje_Send3').classList.add('Active');
            let puntos = ":";
            if (InputB.value === "") {
                let time = InputA.value + puntos + "00";
                let fecha = FechaT.value;
                let observacion = ObservacionT.value;
                Horas(time, user, 4,fecha,observacion);
            } else {
                let time = InputA.value + puntos + InputB.value;
                let fecha = FechaT.value;
                let observacion = ObservacionT.value;
                Horas(time, user, 4,fecha,observacion);
            }
        }
    });



} else {

}

window.addEventListener('load', function () {
    $('#onload').fadeOut();
    $('body').removeClass('hidden');
});





function Eliminar(Usuario) {
    $.ajax({
        url: '../BD/Eliminar_perfil.php',
        type: 'POST',
        data: {
            Usuario: Usuario,
            Accion: 1
        },
        success: function (r) {
            document.getElementById('Messaje_Send').classList.remove('Active');

            if (r == 200) {
                Swal.fire({
                    title: "Perfil eliminado",
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
                    text: 'Ocurrio un problema'
                });
                return false;
            }
        }
    });
}

function Horas(Hora, Usuario, tipo, Fecha, H_entrada, H_salida) {
    $.ajax({
        url: '../BD/Eliminar_perfil.php',
        type: 'POST',
        data: {
            Usuario: Usuario,
            Horas: Hora,
            Campo: tipo,
            Fecha: Fecha,
            H_entrada: H_entrada,
            H_salida: H_salida,
            Accion: 2,
        },
        success: function (r) {
            document.getElementById('Messaje_Send2').classList.remove('Active');
            document.getElementById('Messaje_Send3').classList.remove('Active');

            if (r == 200) {
                Swal.fire({
                    title: "Total de horas actualizadas",
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
                    text: 'Ocurrio un problema'
                });
                return false;
            }

        }
    });
}



//Generate pdf

// let pdf = document.getElementById('Button__Option-Tree');

// pdf.addEventListener('click', () => {

//     $.ajax({
//         url: 'PDF/pdfAsistencias.php',
//         type: 'POST',
//         data: {
//             Action: 1
//         },
//         cache: false,
//         contentType: false,
//         processData: false,
//         success: function (r) {

//             if (r == 3) {
//                 document.getElementById('Alert_Send_Title').innerHTML = "Este documento ya se encuentra registrado";
//                 document.getElementById('Alert_Send').classList.add('Alert_Send-Active');
//                 document.getElementById('Alert_Send').style.backgroundColor = "gold";
//             } else if (r == 200) {
//                 Swal.fire({
//                     title: "Archivo registrado",
//                     icon: "success",
//                     button: "Salir",
//                 }).then(function () {
//                     location.reload();
//                 });
//                 return false;
//             } else if (r == 201) {
//             } else {
//                 Swal.fire({
//                     icon: 'error',
//                     title: 'Oops...',
//                     text: 'Tenemos un problema,.'
//                 });
//                 return false;
//             }

//         }
//     });

// });
