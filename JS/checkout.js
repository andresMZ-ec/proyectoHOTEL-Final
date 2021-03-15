$(document).ready(function(){
    procesarHabitacion();
    capt();
    
    
});


//MOSTRAR HABITACIONES PARA PROCESAR SU PAGO
function procesarHabitacion(){
    $.ajax({
        url: 'check_mostrar.php',
        type: 'GET',
        success: function(response){
            let habitaciones = JSON.parse(response);
            let plantilla = '';
            habitaciones.forEach(capt =>{
                plantilla += `
                    <div getNumHAB="${capt.id}" class="hab-detalle-out">
                        <div class="detalles">
                            <div class="text_hab">
                                <h1 class="number">${capt.numero}</h1>
                                <h3 class="tipo_hab">${capt.tipo}</h3>
                                <h3 class="est_hab-out disponible">${capt.estado}</h3>
                            </div>
                            <div class="photo">
                                <img src="../images/check-out.png" alt="icono de cama">
                            </div>
                        </div>
                        <a href="#" class="process procesar_hab_now">
                            <h3>Procesar Habitación</h3>
                        </a>
                    </div>
                `
            });
            $('#hab_exit').html(plantilla);
        }        
    });
}



function capt(){
    $(document).on('click', '.procesar_hab_now', function(){
        let captdata = $(this)[0].parentElement;
        let id = $(captdata).attr('getNumHAB');
        //DETALLE DE HOSPEDAJE Y PROCESO DE PAGO
        $.post('data-check-out.php', {id}, function(table){
            let structure = JSON.parse(table);
            let template = '';
            structure.forEach(report =>{
                var v, totalPed, totalHos;
                totalPed = report.totalPagar;
                totalHos = report.totalHospedaje;
                if(totalPed == null){
                    v = report.totalHospedaje;
                }else{
                    v = report.totalPagar;
                }
                template += `
                    <div class="header_main">
                        <h2 class="title_apar">Procesar Check Out</h2>
                        <p>Facturación</p>
                    </div>
                    <article class="cont_process">
                        <div id="descRes_cl" class="data_structure">
                            <div class="column-struc">
                                <p class="text-hab">Número de Habitación: <span id="habitac_num">${report.hab}</span></p>
                                <p class="text-hab">Tipo de Habitación:<span id="habitac_type">${report.tipoH}</span></p>
                                <p class="text-hab">Precio por Día:<span id="habitac_price">${report.precioH}</span></p>
                            </div>
                            <div class="column-struc">
                                <p class="text-client">Nombre del Cliente:<span id="client_out_">${report.cliente}</span></p>
                                <p class="text-client">NUI o Pasaporte: <span id="client_out_">${report.NUI}</span></p>
                                <p class="text-client">Correo Electrónico: <span id="client_out_">${report.mail}</span></p>
                            </div>
                            <div class="column-struc reserva">
                                <p class="text-reserva">Fecha y Hora entrada: <span id="reserv_date_in">${report.dateIN}</span></p>
                                <p class="text-reserva">Fecha y Hora salida:<span id="reserv_date_out">${report.dateOUT}</span></p>
                            </div> 
                        </div>
                        <div class="transaccion">
                            <div class="alojamiento">
                                <div class="aloj_head">
                                    <h3>Costo de Hospedaje</h3>
                                </div>
                                <div class="table-trans">
                                    <div class="thead-a">
                                        <div class="grid dta-l">
                                            <h3 class="g1">Valor por Habitación</h3>
                                            <h3 class="g2">Entrada Abonada</h3>
                                        </div>
                                        <div class="grid subtt"><h3>SubTotales</h3></div>
                                    </div>
                                    <div id="price_Hab" class="tbody-a">
                                        <div class="grid dta-l">
                                            <p class="g1">$<span>${report.precioH}</span></p>
                                            <p class="g2">$<span>${report.valorAbonado}</span></p>
                                        </div>
                                        <div class="grid subtt"><p class="price">$<span getPrecio="${report.totalHospedaje}">${report.totalHospedaje}</span></p></div>
                                    </div>
                                </div>
                            </div>
                            <div class="servicios_hab">
                                <div class="s_head">
                                    <h3>Servicio al Cuarto</h3>
                                </div>
                                <div class="table-trans">
                                    <div class="thead-a">
                                        <div class="grid dta-l">
                                            <h3 class="g1">Descripción</h3>
                                            <h3 class="g2">Precio Unitario</h3>
                                            <h3 class="g3">Cantidad</h3>
                                        </div>
                                        <div class="grid subtt"><h3>SubTotales</h3></div>
                                    </div>
                                    <div id="row_product">
                                    </div>
                                </div>
                            </div>
                            <div id="viewTotalPago" class="totales">
                                <p class="txt_t">Totales:</p><p class="subtt total_css">$<span>${v}</span></p>
                            </div>
                        </div>
                        <div class="operation-out">
                            <a href="check-out.php" class="btn-return">Volver</a>
                            <a href="#" id="PayCompleteHos" class="btn-print">Terminar e Imprimir</a>
                        </div>
                    </article>
                `
            });

            $('#updateContend').html(template); 
            //DETALLES DE PRODUCTOS PEDIDOS
            $.post('prueba.php', {id}, function(data){
                let product = JSON.parse(data);
                let plantilla = '';                
                product.forEach(view =>{
                    plantilla += `
                        <div getSubtotal="${view.subtotal_p}" class="tbody-a">
                            <div class="grid dta-l">
                                <p class="g1">${view.description}</p>
                                <p class="g2">$<span>${view.pvp}</span></p>
                                <p class="g3">${view.cantidad}</p>
                            </div>
                            <div data-product ="101" class="grid subtt"><p>$<span >${view.subtotal_p}</span></p></div>
                        </div>
                    `
                });
                $('#row_product').html(plantilla); 
            });

            $('#PayCompleteHos').on('click',function(e){
                e.preventDefault();
                window.print();
                window.location.href='admin.php';
                /* $.post('check-out/processHab.php', {id}, function(mensaje){
                    console.log(mensaje);
                    if(mensaje == 'Datos procesados correctamente'){
                    }else{
                        alert(mensaje);
                    } 
                }) */
            })
        });         
    });
}




