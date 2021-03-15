$(document).ready(function(){
    $('#loginCompleteBTN').click(function(e){
        e.preventDefault();
        var campos = {
            user: $('#inputMailSend').val(),
            password: $('#inputPassSend').val()
        }
        $.post('login/validar.php', campos, function(resp){            
            let mensaje = resp;
            console.log(mensaje);
            if(mensaje == 'Usuario no registrado' || mensaje == 'Datos no enviados'){
                alert(mensaje);
                window.location.href = "login.html";
            }else{
                if(mensaje == 'redirigiendo'){
                    window.location.href = "admin.php";
                }
            }
            /* let template = '';
            mensaje.forEach(mostrar =>{
                template += `<p style=" font-size: 11px; font-weight: 300; color: #fff; text-align: center;">${mostrar}</p>`
            })
            $('#repServerAlert').html(template); */
        })
    });
})