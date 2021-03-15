$(document).ready(function(){
    abrirNuevaReserva();
    ventanaEditar();
    mostrarReservas();
    estadoGeneral(); 


    addReserva();
    updateReserva();
});

function estadoGeneral(){
    $.ajax({
        url: 'general.php',
        type: 'GET',
        success: function(response){
            let cantidad = JSON.parse(response);
            let templ_hab = '';
            let templ_res = '';
            let templ_emp = '';
            cantidad.forEach(cant => {
                templ_hab += `<span>${cant.count}</span>`
                templ_res += `<span>${cant.cant_res}</span>`
                templ_emp += `<span>${cant.cant_empl}</span>`
            });            
            $('#hab_dtll').html(templ_hab);
            $('#res_dtll').html(templ_res);
            $('#emp_dtll').html(templ_emp);
        }
    });
    setTimeout("estadoGeneral()",1000);
};

function mostrarReservas(){
    $.ajax({
        url: 'view-reserva.php',
        type: 'GET',
        success: function(reservas){    
            let detalle = JSON.parse(reservas);
            let agregar = '';
            let event = '';
            detalle.forEach(mostrar => {
                var est, dateIN, dateOUT, dateActual, hourActual, timeWait;
                est = '';
                dateIN = mostrar.entrada;
                dateOUT = mostrar.salida;    
                function addZero(x,n){
                    while (x.toString().length < n) {
                        x = "0" + x;
                    }
                    return x;
                }
                const d = new Date();                
                const w = new Date(dateOUT);
                dateActual = addZero(d.getFullYear(),2)+'-'+addZero((d.getMonth()+1),2)+'-'+addZero(d.getDate(),2)+' '+addZero(d.getHours(),2)+':'+addZero(d.getMinutes(),2)+':'+addZero(d.getSeconds(),2);                      
                timeWait = addZero(w.getFullYear(),2)+'-'+addZero((w.getMonth()+1),2)+'-'+addZero(w.getDate(),2)+' '+addZero(w.getHours(),2)+':'+addZero(w.getMinutes()+20,2)+':'+addZero(w.getSeconds(),2); 
                
                if(dateIN>dateActual){
                    est = 'Reservado';
                    var data = {
                        num : mostrar.numHab,
                        estado : est
                    }
                    $.post('admin/update-est-hab.php', data);
                }else{
                    if(dateIN<dateActual && dateOUT>dateActual){
                        est='Ocupado';
                        var data = {
                            num : mostrar.numHab,
                            estado : est
                        }
                        $.post('admin/update-est-hab.php', data);
                    }else{
                        if((dateOUT<timeWait) && (dateOUT<dateActual) && (dateActual<timeWait)){
                            est = 'Limpieza'; 
                            var data = {
                                num : mostrar.numHab,
                                estado : est
                            }
                            $.post('admin/update-est-hab.php', data);                            
                        }else{
                            if(dateActual>timeWait){
                                est = 'Disponible';
                                var data = {
                                    num : mostrar.numHab,
                                    estado : est
                                }
                                $.post('admin/update-est-hab.php', data);
                            }
                        }
                    }                    
                }

                agregar += `
                    <div getNum="${mostrar.numHab}" class="row_res">
                        <div class="hab_name_res"><p><i class="txt-dtll-hab">Habitacion</i><span id="num_hab_res">${mostrar.numHab}</span></p></div>
                        <div class="est_reser_res">${mostrar.tipoRes}</div>
                        <div id="estado_row" class="est_hab_res ${est}">${est}</div>
                        <div class="limit"><p>Desde:</p><p>Hasta:</p></div>
                        <div class="date_res"><p>${mostrar.fechaIN}</p><p>${mostrar.fechaOUT}</p></div>
                        <div class="hour_res"><p>${mostrar.HourIN}</p><p>${mostrar.horaOUT}</p></div>
                        <div class="operacion_res">
                            <a class="modi_res mod_res_btn" href="#">Modificar</a>
                        </div>
                    </div>
                `
            });
            $('#list_reservas').html(agregar);
        }
    });
    setTimeout("estadoGeneral()",1000);
}


function abrirNuevaReserva(){    
    $('#new_reserva').click(function(e){
        e.preventDefault();       
        var contAbrir= document.getElementById('container_form'); 
        var formulario = document.getElementById('formulario_r');
        contAbrir.classList.add('active')
        setTimeout(function(){            
            formulario.classList.add('active');
        },100);
        var btnCerrarForm = $('#cancel_res');
        btnCerrarForm.click(function(){
            if($('#formulario_r').hasClass('active')){
                formulario.classList.remove('active');
                setTimeout(function(){
                    contAbrir.classList.remove('active');
                }, 200);
            }
        });  
    });
};




function ventanaEditar(){
    $(document).on('click', '.mod_res_btn', function(){
        const abrirVentEdit = document.getElementById('ventanaEditarReserva');
        abrirVentEdit.classList.add('active');

        let element = $(this)[0].parentElement.parentElement;
        let num = $(element).attr('getNum');

        $.post('buscar-reserva.php', {num}, function(response){
            let obtenido = JSON.parse(response);            
            let add = '';          
            obtenido.forEach(view =>{
                add += `
                    <input type="hidden" id="edt_res" value="${view.reservaID}">
                    <div class="registros"><span>Fecha de Entrada:</span><div class="caja-escrit"><input type="text" value="${view.entrada}" id="edt_dateIN"></div> </div>
                    <div class="registros"><span>Fecha de Salida:</span><div class="caja-escrit"><input type="text" value="${view.salida}" id="edt_dateOUT"></div> </div>
                    <div class="registros reserva_input"><span>Habitación actual : ${view.hab_num}</span> 
                        <select name="tipo_hab" id="edt_habNUM" required>
                            <option value="${view.id}">${view.hab_num}</option>
                        </select>
                    </div> 
                    <div class="registros"><span>Nombre Cliente:</span><div class="caja-escrit"><input type="text" value="${view.nameCl}" id="edt_name"></div> </div>
                    <div class="registros"><span>Apellido Cliente:</span><div class="caja-escrit"><input type="text" value="${view.apellidoCL}" id="edt_apell"></div> </div>
                    <div class="registros"><span>Abonado:</span><div class="caja-escrit"><input type="text" value="${view.abono}" id="edt_abono"></div> </div>
                        
                        
                    <div class="registros reserva_indivut"><span>Tipo de Reserva : ${view.tipoReserva_name}</span>
                        <select name="tipo_res" id="edt_typeRes">
                            <option value="${view.tipoReserva_id}">${view.tipoReserva_name}</option>                            
                        </select>
                    </div>
                `
            });
            $('#viewDataReserva_Edit').html(add); 
        });
        
    });
};


/* function mostrar2(){
    $.ajax({
        url: 'prueba.php',
        type: 'GET',
        success: function(respuesta){
            let data = JSON.parse(respuesta);
            let hab = '';
            data.forEach(p =>{
                hab += `<option value="${p.id_num}">${p.name_num}</option>`
            });
            $('#edt_habNUM').html(hab);
            console.log(hab);
        }
    });
} */


//GUARDAR LOS DATOS EN LA BASE DE DATOS
function addReserva(){   
    $('#formulario_r').submit(function(e){
        e.preventDefault();
        const Datapost = {
            tipoID: $('#tipoDoc_cl').val(),
            nombreCL: $('#firstN_cli').val(),
            apellidoCL: $('#lastN_cli').val(),
            correo: $('#mail_cl').val(),
            celular: $('#cell_cl').val(),
            numeroID: $('#numId_cl').val(),
            
            fechaIN: $('#dateIn_r').val(),
            fechaOUT: $('#dateOut_r').val(),
            numHab_r: $('#habit_tipo').val(),
            tipoReserva: $('#reserva_est').val(),
            abono: $('#abonado_price').val()
        };
        console.log(Datapost);
        $.post('add-reserva.php', Datapost, function(response){
            let mensaje = response;
            var cerrarVentana= document.getElementById('container_form');
            var formulario = document.getElementById('formulario_r');
            if(mensaje == 'Reserva ingresada satisfactoriamente'){
                alert(mensaje);
                $('#formulario_r').trigger('reset');  
                formulario.classList.remove('active');
                setTimeout(function(){
                    cerrarVentana.classList.remove('active')              
                },200);                
            }else{
                if(mensaje == 'Ingrese todos los campos.'){
                    alert(mensaje);
                }
            }
            mostrarReservas();
        });
    })
}



function updateReserva(){   
    $('#saveEdit_r').submit(function(e){
        e.preventDefault();
        const dataEdit = {
            id: $('#edt_res').val(),
            dateIN: $('#edt_dateIN').val(),
            dateOUT: $('#edt_dateOUT').val(),
            habID: $('#edt_habNUM').val(),
            nameCL: $('#edt_name').val(),
            apellCL: $('#edt_apell').val(),
            abonado: $('#edt_abono').val(),            
            typeRes: $('#edt_typeRes').val()
        };

        $.post('edit-reserva.php', dataEdit, function(response){
            let mensaje = response;
            var ventana = document.getElementById('ventanaEditarReserva');
            if(mensaje == 'Datos actualizados satisfcatoriamente'){
                alert(mensaje);
                ventana.classList.remove('active');
            }else{
                if(mensaje == 'Todos los campos son requeridos'){
                    alert(mensaje);
                }
            }
            mostrarReservas();            
        });
    })
}








//FUNCION PARA CERRAR LA VENTANA EMERGENTE DE EDITAR RESERVA
function closeVentEmergente(){
    var ventana = document.getElementById('ventanaEditarReserva');
    if($('#ventanaEditarReserva').hasClass('active')){
        ventana.classList.remove('active');
    }else{
        console.log('error al cerrar');
    }
}




