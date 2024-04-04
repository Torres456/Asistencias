const txtClock = document.getElementById('txtClock');
const txtDate = document.getElementById('txtDate');

(function(){
    var hora_fecha = function(){
        var fe = new Date(),
        ho = fe.getHours(),AMPM,
        min = fe.getMinutes(),
        se = fe.getSeconds(),
        DS = fe.getDay(),
        di = fe.getDate(),
        me = fe.getMonth(),
        ye = fe.getFullYear();

        // var InputFecha = document.getElementById('textfecha');
        // const InputHora_E = document.getElementById('textentrada');

        
        // var InputPrue = document.getElementById('texthora_prueva');
     

        var semana = ['Domingo', 'Lunes', 'Martes','Miercoles', 'Jueves', 'Viernes', 'Sabado']
        var mes = ['Enero','Febrero','Marzo','Abril','Mayo','Junio','Julio','Agosto','Septiembre','Octubre','Noviembre','Diciembre']
       
        
        txtDate.innerHTML=semana[DS]+'-'+di+'-'+mes[me]+'-'+ye;
         date = ye+'-'+me+'-'+di;


        if (ho >= 12){
            ho = ho -12;
            AMPM = 'PM';
        }else{
            AMPM = 'AM';
        }
        if (ho == 0){
            ho = 12;
        }
        if (min < 10 ){
            min = '0' + min;
        }
        if (se < 10 ){
            se = '0' + se;
        }
        if (ho < 10 ){
            ho = '0' + ho;
        }
    
        
        txtClock.innerHTML=ho+' : '+min+' : '+se+' '+ AMPM;
        
    };
 
    hora_fecha();
    var intval = setInterval(hora_fecha, 1000);
}())