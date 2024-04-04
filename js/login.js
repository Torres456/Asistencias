let Button = document.getElementById('Form__Button');
let User = document.getElementById('Usuario');
let Pass = document.getElementById('Contraseña');
let Btn_Error_cerrar = document.getElementById('Btn_Error_cerrar');


//Close-alert-button--->
Btn_Error_cerrar.addEventListener('click', () => {
    document.getElementById('Alert_Send').classList.remove('Alert_Send-Active');
});

Button.addEventListener('click',(e)=>{

e.preventDefault();

document.getElementById('Alert_Send').classList.remove('Alert_Send-Active');

if(User.value === ""){
    document.getElementById('Alert_Send_Title').innerHTML = "Ingresa un usuario";
    document.getElementById('Alert_Send').classList.add('Alert_Send-Active');
}else if(Pass.value === ""){
    document.getElementById('Alert_Send_Title').innerHTML = "Ingresa una contraseña";
    document.getElementById('Alert_Send').classList.add('Alert_Send-Active');
}else{
    document.getElementById('Messaje_Send').classList.add('Active');
    document.getElementById('Messaje_Send').innerHTML = "Verificando...";
    Envio();

}

});


function Envio(){
    $.ajax({
        type: "POST",
        url: "../BD/loginE.php",
        data: {
            Usuario: document.getElementById('Usuario').value,
            Password: document.getElementById('Contraseña').value,
            Action:1
        },
        success: function (r) {
            document.getElementById('Messaje_Send').classList.remove('Active');
            if (r == 2) {
                document.getElementById('Alert_Send_Title').innerHTML = "Usuario no encontrado";
                document.getElementById('Alert_Send').classList.add('Alert_Send-Active');
                document.getElementById('Alert_Send').style.backgroundColor = "gold";
            }else if(r == 4){
                document.getElementById('Alert_Send_Title').innerHTML = "Contraseña incorrecta";
                document.getElementById('Alert_Send').classList.add('Alert_Send-Active');

            } else if (r == 200) {
               
                $(location).attr('href', 'panel.php');
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