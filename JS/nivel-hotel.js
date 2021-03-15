$(document).ready(function(){
    verNiveles();
    addNivel();
    updateNivel();
})

function verNiveles(){
    $.ajax({
        url: 'niveles/viewNiveles.php',
        type: 'GET',
        success: function(response){
            let niveles = JSON.parse(response);
            let plantilla = '';
            niveles.forEach(nivel => {
                plantilla += `
                <div class="tbody" data-nivel="${nivel.id}">
                    <p class="id_hab">${nivel.id}</p>
                    <p class="name_hab">${nivel.nivelName}</p>
                    <p class="btn_oper"><a href="#" onclick="openVentUpdate()" class="editar btnEditNivelDB">Editar</a></p>
                    <p class="btn_oper"><a href="#" onclick="openVentDelete()" class="delete btnDeleteNivelDB">Eliminar</a></p>
                </div> 
                `
            })
            $('#nivelesTableView').html(plantilla);
        }
    })
}

function addNivel(){
    $('#btnAddNivelNEW').click(function(e){
        e.preventDefault();
        var dataCliente = {
            nombre: $('#nameNewNivel').val()
        }
        $.post('niveles/add-nivel.php', dataCliente, function(resp){
            let mensaje = resp;
            var cerrarVentana= document.getElementById('overlay_ventAgregar');
            if(mensaje == 'Altura del Hotel ingresado correctamente'){
                alert(mensaje);
                $('#formAddNivel').trigger('reset');  
                cerrarVentana.classList.remove('active');              
                verNiveles();
            }else{
                if(mensaje == 'Ingrese el nombre.'){
                    alert(mensaje);
                }
            }
        });
    })
}
function updateNivel(){
    $(document).on('click', '.btnEditNivelDB', function(){
        var element = $(this)[0].parentElement.parentElement;
        var nivel = $(element).attr('data-nivel');
        $.post('niveles/find-nivel.php', {nivel}, function(resp){
            let data = JSON.parse(resp);
            let tmpl = '';
            data.forEach(e=>{
                tmpl += `
                    <input type="hidden" id="idNivell" value="${e.id}">
                    <p>Nivel Habitación: <input type="tel" id="nivel_nombreID" value="${e.nombre}"></p>
                    <div class="btn-edit-cmp">
                        <a class="btn_cancel_edit" onclick="openVentUpdate()" href="#">Cancelar</a>
                        <a class="btn_save_edit submitNivelEdit" href="#">Guardar Cambios</a>
                    </div>
                `
            })
            $('#resulDBNivel').html(tmpl);
        })
        $(document).on('click', '.submitNivelEdit', function(){
            var id = {
                id: $('#idNivell').val(),
                nombre: $('#nivel_nombreID').val()
            }
            $.post('niveles/edit-nivel.php', id, function(respuesta){
                let mensaje = respuesta;
                var vent = document.getElementById('overlay_ventModificar');
                if(mensaje == 'Cambios guardados correctamente'){
                    alert(mensaje);
                    vent.classList.remove('active');
                    verNiveles();
                }else{
                    alert(mensaje);
                }
            })
        })
    })
}


function openVentAgg(){
    var window = document.getElementById('overlay_ventAgregar');
    if($('#overlay_ventAgregar').hasClass('active')){
        window.classList.remove('active');
    }else{
        window.classList.add('active');
    }
}

function openVentUpdate(){
    var window = document.getElementById('overlay_ventModificar');
    if($('#overlay_ventModificar').hasClass('active')){
        window.classList.remove('active');
    }else{
        window.classList.add('active');
    }
}

function openVentDelete(){
    var window = document.getElementById('overlay_ventAgregar');
    if($('#overlay_ventAgregar').hasClass('active')){
        window.classList.remove('active');
    }else{
        window.classList.add('active');
    }
}