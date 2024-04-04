const inputF = document.getElementById('file-5');
const Btn_Error_cerrar = document.getElementById('Btn_Error_cerrarA');

let Btn_Password = document.getElementById('Btn_Password');
let Img_Password = document.getElementById('Btn_Password');
let Input__Password = document.getElementById('Input__Password');

let Button__Option_Three = document.getElementById('Button__Option_Three');

Btn_Error_cerrar.addEventListener('click', () => {
    document.getElementById('Alert_Send').classList.remove('Alert_Send-Active');
});

var testData = !!document.getElementById("Input__Password");
if (testData) {

    let num = 0;
    Input__Password.setAttribute("disabled", "");

    Btn_Password.addEventListener('click', () => {
 
        if (num == 0) {
            Img_Password.setAttribute("src", "assets/images/visibility_on.png");
            Input__Password.setAttribute("type", "text");
            num = 1;
        } else {
            Img_Password.setAttribute("src", "assets/images/visibility_off.png");
            Input__Password.setAttribute("type", "password");
            num = 0;

        }

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

    const maxSize = 2;


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

    // Cerrar seción

    Button__Option_Three.addEventListener('click',()=>{

        document.getElementById('Box__Items').classList.add('Display');
        Swal.fire({
            title: "¿Deseas cerrar tu seción?",
            text: "Tu seción se cerrara",
            icon: "warning",
            showCancelButton: true,
            confirmButtonColor: "#3085d6",
            cancelButtonColor: "#d33",
            confirmButtonText: "Si, salir!"
        }).then((result) => {
            if (result.isConfirmed) {
                cerrar();
            }else{
                document.getElementById('Box__Items').classList.remove('Display');

            }
        });
    });


    function cerrar() {
        $.ajax({
            type: "POST",
            url: "../BD/CerrarSecion.php",
            data: {
                option:1
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



} else {


}

window.addEventListener('load', function () {
    $('#onload').fadeOut();
    $('body').removeClass('hidden');
});