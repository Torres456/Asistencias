
const cloud = document.getElementById("cloud");
const barraLateral = document.querySelector(".barra-lateral");
const spans = document.querySelectorAll("span");

let salir = document.getElementById('Salir');





const circulo = document.querySelector(".circulo");
const menu = document.querySelector(".menu");
const main = document.querySelector("main");

var test =document.querySelectorAll('.main')
let option=test[0].id.concat('B');
document.getElementById(option).classList.add('ActiveElment');
menu.addEventListener("click",()=>{
    barraLateral.classList.toggle("max-barra-lateral");
    if(barraLateral.classList.contains("max-barra-lateral")){
        menu.children[0].style.display = "none";
        menu.children[1].style.display = "block";
    }
    else{
        menu.children[0].style.display = "block";
        menu.children[1].style.display = "none";
    }
    if(window.innerWidth<=320){
        barraLateral.classList.add("mini-barra-lateral");
        main.classList.add("min-main");
        spans.forEach((span)=>{
            span.classList.add("oculto");
        })
    }
});

cloud.addEventListener("click",()=>{
    barraLateral.classList.toggle("mini-barra-lateral");
    main.classList.toggle("min-main");
    spans.forEach((span)=>{
        span.classList.toggle("oculto");
    });
});


salir.addEventListener('click',()=>{
    // document.getElementById('Box__Items').classList.add('Display');
    Swal.fire({
        title: "¿Deseas cerrar tu sesión?",
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
            // document.getElementById('Box__Items').classList.remove('Display');

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