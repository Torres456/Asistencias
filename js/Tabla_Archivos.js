
$(buscarDatos());
function buscarDatos() {
    $.ajax({
        url: '../BD/Carga_archivos.php',
        type: 'POST',
        dataType: 'html',
        cache: 'none',
        data: {},
    })
        .done(function (respuesta) {
            $("#datos").html(respuesta);
            let Table_Buttons = document.querySelectorAll('.Table__Button');


            Table_Buttons.forEach((button, i) => {
                Table_Buttons[i].addEventListener('click', () => {

                    var archivo = Table_Buttons[i].id
                    // alert(archivo);
                    Swal.fire({
                        title: "¿Deseas eliminar este archivo?",
                        text: "Esta acción no se puede rebertir",
                        icon: "warning",
                        showCancelButton: true,
                        confirmButtonColor: "#3085d6",
                        cancelButtonColor: "#d33",
                        confirmButtonText: "Si, eliminar!"
                    }).then((result) => {
                        if (result.isConfirmed) {
                            Envio(archivo);

                        }
                    });
                });


            });
        })
        .fail(function () {
            console.log("error");
        })
}

function Envio(Archivo) {
    $.ajax({
        type: "POST",
        url: "../BD/Eliminar_Documento.php",
        data: {
            Archivo: Archivo,
            User:document.getElementById('Label_Matricula').innerHTML
        },
        success: function (r) {
            if (r == 200) {

                Swal.fire({
                    title: "Documento eliminado",
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
                    text: 'El archivo no existe o no se puede eliminar.'
                }).then(function () {
                    location.reload();
                });
                return false;

            }
        }
    });
}