$(document).ready(function(){
    verTipo();
    addTipo();
    updateTipo();
})

function verTipo(){
    $.ajax({
        url: 'categorias/viewTipoHab.php',
        type: 'GET',
        success: function(response){
            let niveles = JSON.parse(response);
            let plantilla = '';
            niveles.forEach(nivel => {
                plantilla += `
                <div class="tbody" data-cate="${nivel.id}">
                    <p class="id_hab">${nivel.id}</p>
                    <p class="name_hab">${nivel.nivelName}</p>
                    <p class="btn_oper"><a href="#" onclick="openVentUpdate()" class="editar btnEditTipoDB">Editar</a></p>
                    <p class="btn_oper"><a href="#" onclick="openVentDelete()" class="delete">Eliminar</a></p>
                </div> 
                `
            })
            $('#TableViewTipo').html(plantilla);
        }
    })
}

function addTipo(){
    $('#btnAddTipoNEW').click(function(e){
        e.preventDefault();
        var dataTipo = {
            nombre: $('#nameNewtTipo').val()
        }
        $.post('categorias/add-tipo-hab.php', dataTipo, function(resp){
            let mensaje = resp;
            var cerrarVentana= document.getElementById('overlay_ventAgregar');
            if(mensaje == 'Tipo de habitacion ingresado correctamente'){
                alert(mensaje);
                $('#formAddTipo').trigger('reset');  
                cerrarVentana.classList.remove('active');              
                verTipo();
            }else{
                if(mensaje == 'Ingrese el nombre.'){
                    alert(mensaje);
                }
            }
        });
    })
}

function updateTipo(){
    $(document).on('click', '.btnEditTipoDB', function(){
        var element = $(this)[0].parentElement.parentElement;
        var categoria = $(element).attr('data-cate');
        $.post('categorias/find-categorias.php', {categoria}, function(resp){
            let data = JSON.parse(resp);
            let tmpl = '';
            data.forEach(e=>{
                tmpl += `
                    <input type="hidden" id="idcatt" value="${e.id}">
                    <div class="data">
                        <label for="type_hab">Nombre:</label>
                        <input type="tel" id="catt_nombreID" value="${e.nombre}">
                    </div>
                    <button class="btn_save submitCEdit" type="submit">Guardar Cambios</button>
                `
            })
            $('#resulDBCat').html(tmpl);
        })
        $(document).on('click', '.submitCEdit', function(){
            var id = {
                id: $('#idcatt').val(),
                nombre: $('#catt_nombreID').val()
            }
            $.post('categorias/edit-categoria.php', id, function(respuesta){
                let mensaje = respuesta;
                var vent = document.getElementById('overlay_ventModificar');
                if(mensaje == 'Cambios guardados correctamente'){
                    alert(mensaje);
                    vent.classList.remove('active');
                    verTipo();
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