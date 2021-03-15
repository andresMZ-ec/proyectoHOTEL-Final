$(document).ready(function(){
    viewHabitaciones();
    agregarHabitacion();
    eliminarHabitacion();
    editarHabitacion();
});


function viewHabitaciones(){
    $.ajax({
        url: 'habitacion/ver-habitaciones.php',
        type: 'GET',
        success: function(respuesta){
            let data = JSON.parse(respuesta);
            let template = '';
            data.forEach(e => {
                var estClase;
                let estadoColor = e.estado;
                switch (estadoColor){
                    case 'Disponible':
                        estClase = 'disponible';                        
                        break;
                    case 'Ocupado':
                        estClase = 'ocupado';
                        break;
                    case 'Limpieza':
                        estClase = 'limpieza';
                        break;  
                    case 'Reservado':
                        estClase = 'reservado';
                        break;
                }
                template += `
                <div class="box ${estClase}">
                    <div class="descrip_box">
                        <div class="text_hab">
                            <h1 class="number">${e.numero}</h1>
                            <h3 class="tipo_hab">${e.tipo}</h3>
                            <h5 class="cant_huesp">Huéspedes ${e.huespedes}</h5>
                        </div>
                        <div class="photo">
                            <img src="../images/${estClase}.png" alt="icono de cama">
                        </div>
                    </div>
                    <div class="est_hab ${estClase}">
                        <span>${e.estado}</span>
                    </div>
                    <div id="reserveNow" class="process_hab">
                        <h3>Reservar Habitación</h3>                        
                    </div>
                </div>
                `
            })
            $('#viewHab').html(template);
        }
    })
}

function agregarHabitacion(){
    $('#btnAggNewHab').click(function(e){
        e.preventDefault();
        var obtData = {
            number : $('#add_numero_hab').val(),
            price : $('#add_precio_hab').val(),
            roomer : $('#add_huesp_hab').val(),
            descrip : $('#add_desc_hab').val(),
            category : $('#add_tipo_hab').val(),
            heigthHTL : $('#add_nivel_hab').val()
        }
        $.post('habitacion/add-new-hab.php', obtData, function(response){
            console.log(response);
        })
    })
}


function eliminarHabitacion(){
    $('#sendID_dlt').click(function(e){
        e.preventDefault();
        if(confirm('¿Esta seguro de eliminar la habitación?')==true) {
            var habSelect = {
                id: $('#idHabDelete').val()
            }
            $.post('habitacion/delete-habitacion.php', habSelect, function(response){
                let mensaje = response;
                alert(mensaje);
            });
            mostrarReservas();
        }else{
            alert('Eliminación cancelada')
       }       
    })
}


function editarHabitacion(){
    $('#hab_edithab').on('change', function(){
        var contEdit = document.getElementById('wDatahab');
        setTimeout(function(){
            contEdit.style.display = "block";
        }, 500);
        seleccionCategoria();
        seleccionNivel();
        var selection = {
            id: $('#hab_edithab').val()
        }
        $.post('habitacion/search-habit.php', selection, function(resp){
            let data = JSON.parse(resp);
            let hab = '',
                id = '',
                precio = '',
                huesped = '',
                description = '';            
            data.forEach(f =>{
                id += `<input id="correctID" type="hidden" value="${f.id}">`
                hab += `Número de Habitación: <input id="dataUpdateNum" type="tel" value="${f.num_h}">`              
                precio += `Precio de Habitación: <input id="dataUpdatePvp" type="tel" value="${f.precio}">`              
                huesped += `Cantidad de Huéspedes: <input id="dataUpdateHuesp" type="tel" value="${f.huesped}">`              
                description += `Descripción de Habitación: <textarea id="dataUpdateDescrp" cols="30" rows="10">${f.descripcion}</textarea>`              
            })
            $('#notRan').html(id); 
            $('#correctHab').html(hab); 
            $('#correctPrecio').html(precio); 
            $('#correctHuesped').html(huesped); 
            $('#correctDescrp').html(description); 
        });        
    });
    //funcion de jquery con ajax para actualizar datos en la base de datps
    $('#saveData_modf').click(function(e){
        e.preventDefault();
        var dataHab = {
            id: $('#correctID').val(),
            num: $('#dataUpdateNum').val(),
            precio: $('#dataUpdatePvp').val(),
            huespedes: $('#dataUpdateHuesp').val(),
            categoria: $('#edit_catHab').val(),
            nivel: $('#edit_nivelHab').val(),
            descripcion: $('#dataUpdateDescrp').val()
        }
        $.post('habitacion/edit-habitacion.php', dataHab, function(sms){
            console.log(sms);
        })
    })
}

    function seleccionNivel(){
        var idLevel = $('#hab_edithab').val();
        $.ajax({
            type: 'POST',
            url: 'habitacion/select-nivel.php',
            data: {'idLevel': idLevel},
        }).done(function(camposLvl){
            $('#edit_nivelHab').html(camposLvl);
        })
    }
    function seleccionCategoria(){        
        var id = $('#hab_edithab').val();
        $.ajax({
            type: 'POST',
            url: 'habitacion/select-category.php',
            data: {'id': id},
        }).done(function(campos){
            $('#edit_catHab').html(campos);
        }) 
    }




function Windowinsert(){
    var ventana = document.getElementById('insertNewRoom');
    if($('#insertNewRoom').hasClass('active')){
        ventana.classList.remove('active');
    }else{
        ventana.classList.add('active');
    }
}
function WindownEdit(){
    var ventana = document.getElementById('editNewRoom');
    if($('#editNewRoom').hasClass('active')){
        ventana.classList.remove('active');
    }else{
        ventana.classList.add('active');
    }
}
function Windowndelete(){
    var ventana = document.getElementById('deleteNewRoom');
    if($('#deleteNewRoom').hasClass('active')){
        ventana.classList.remove('active');
    }else{
        ventana.classList.add('active');
    }
}
    