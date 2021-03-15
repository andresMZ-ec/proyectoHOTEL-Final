$(document).ready(function(){
    viewClientes();
    addCliente();
    updateCliente();
    deleteCliente();
});

function viewClientes(){
    $.ajax({
        url: 'clientes/ver-clientes.php',
        type: 'GET',
        success: function(response){
            let clientes = JSON.parse(response);
            let plantilla = '';
            clientes.forEach(cliente => {
                plantilla += `
                <div class="row_cli" data-cliente="${cliente.id}">
                    <p class="type-doc">${cliente.tipoDoc}</p>
                    <p class="num_id">${cliente.numID}</p>
                    <p class="names_cli">${cliente.nombreApellido}</p>
                    <p class="mail_cli">${cliente.correo}</p>
                    <p class="cell_cli">${cliente.celular}</p>
                    <p class="estado_out porpagar">Proximo</p>
                    <div class="botones"><a href="#" onclick="openVentUpdate()" class="btn_edit_cli"><i class="fas fa-edit"></i>Editar</a></div>
                    <div class="botones"><a href="#" class="btn_dlt_cli"><i class="far fa-trash-alt"></i>Eliminar</a></div>
                </div> 
                `
            })
            $('#mostrarCliente').html(plantilla);
        }
    })
}

function addCliente(){
    $('#btnAddClienteNEW').click(function(e){
        e.preventDefault();
        var dataCliente = {
            nombreCL: $('#nameNewCLiente').val(),
            apellidoCL: $('#apellNewLliente').val(),
            numeroID: $('#nui_clienteo').val(),
            tipoID: $('#tipoIDNewCliente').val(),
            correo: $('#mailNewLliente').val(),
            celular: $('#cellNewLliente').val()
        }
        $.post('clientes/add-cliente.php', dataCliente, function(resp){
            let mensaje = resp;
            var cerrarVentana= document.getElementById('overlay_ventAgregar');
            if(mensaje == 'Cliente ingresado satisfactoriamente'){
                alert(mensaje);
                $('#formulario_r').trigger('reset');  
                cerrarVentana.classList.remove('active');              
                viewClientes();
            }else{
                if(mensaje == 'Ingrese todos los campos.'){
                    alert(mensaje);
                }
            }
        });
    })
    
}

function updateCliente(){    
    $(document).on('click', '.btn_edit_cli', function(){
        var element = $(this)[0].parentElement.parentElement;
        var id = $(element).attr('data-cliente');
        $.post('clientes/find-cl.php', {id}, function(resp){
            let data = JSON.parse(resp);
            let tmpl = '';
            data.forEach(e=>{
                tmpl += `
                <div class="column">
                    <input type="hidden" id="idClienUpdateSend" value="${e.id}">
                    <label for="name_cliente">Nombres:</label>
                    <input type="text" id="nameCLienteEdit" value="${e.name_cliente}">
                    <label for="nui_cliente">Número de ${e.typeDOC}:</label>
                    <input type="tel" id="nuiCLienteEdit" value="${e.nui_cliente}">
                    <label for="mail_cliente">Correo Electrónico:</label>
                    <input type="text" id="mailCLienteEdit" value="${e.mail_cliente}">                            
                </div>

                <div class="column">
                    <label for="tipo_hab">Apellidos:</label>
                    <input type="text" id="apellidosCLienteEdit" value="${e.apellidos_cliente}">   
                    <label for="tel_cliente">Teléfono:</label>
                    <input type="tel" id="cellCLienteEdit" value="${e.cell_cliente}">                            
                </div>
                `
            })
            $('#dataCLienteEdit').html(tmpl);
        })
        

        $('#btnUpdateCliente').click(function(e){
            e.preventDefault();
            var dataCliente = {
                id: $('#idClienUpdateSend').val(),
                nombreCL: $('#nameCLienteEdit').val(),
                apellidoCL: $('#apellidosCLienteEdit').val(),
                numeroID: $('#nuiCLienteEdit').val(),
                correo: $('#mailCLienteEdit').val(),
                celular: $('#cellCLienteEdit').val()
            }
            $.post('clientes/edit-cliente.php', dataCliente, function(resp){
                let mensaje = resp;
                var cerrarVentana= document.getElementById('overlay_ventModificar');
                if(mensaje == 'Datos actualizados correctamente'){
                    alert(mensaje);
                    cerrarVentana.classList.remove('active');              
                    viewClientes();
                }else{
                    alert(mensaje);                    
                }                
            }); 
        })
    });
}

function deleteCliente(){
    $(document).on('click', '.btn_dlt_cli', function(){
        var element = $(this)[0].parentElement.parentElement;
        var id = $(element).attr('data-cliente');
        if(confirm('¿Esta seguro de eliminar el Cliente?')==true) {
            var cliente = {
                id: id
            }
            $.post('clientes/delete-cliente.php', cliente, function(response){
                let mensaje = response;
                alert(mensaje);
                viewClientes();
            });
        }else{
            alert('Eliminación cancelada');
        } 
    });
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