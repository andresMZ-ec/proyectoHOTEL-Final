$(document).ready(function(){
    //console.log('hola');
    datosEmpleado();
    //activarElementos();
});

function abrirMenu(){
    var nav = document.getElementById('navHotelCont');
    if($('#navHotelCont').hasClass('active')){
        nav.classList.remove('active');
    }else{
        nav.classList.add('active');
    }
}

function datosEmpleado(){
    $.ajax({
        url: 'menu.php',
        type: 'GET',
        success: function(empleado){
            let emp = JSON.parse(empleado);
            $('#mailEmp').html(`<a href="#">${emp.mail}</a>`);
            $('#dataEmp').html(`<p class="tipo_user">${emp.typeUser}</p>
                                <p class="name_user">${emp.nombre}</p>`);
        }
    });
    setTimeout('datosEmpleado()',1000);
}



function servicios(){
    var opcion = document.getElementById('servicios');
    var optbtn= document.getElementById('btn_downSer');
    var mostrar = document.getElementById('view_servicios');
    if($('#servicios').hasClass('active')){
        opcion.classList.remove('active');
        mostrar.classList.remove('active');
        optbtn.classList.remove('active');
    }else{
        opcion.classList.add('active');
        mostrar.classList.add('active');
        optbtn.classList.add('active');
    }
}
function administracion(){
    var opcion = document.getElementById('btnAdmin');
    var optbtn= document.getElementById('btn_downAdm');
    var mostrar = document.getElementById('mostrarSubAdmin');
    if($('#mostrarSubAdmin').hasClass('active')){
        opcion.classList.remove('active');
        optbtn.classList.remove('active');
        mostrar.classList.remove('active');
    }else{
        opcion.classList.add('active');
        optbtn.classList.add('active');
        mostrar.classList.add('active');
    }
}