
function activarVentana(){
	var ventanaAdd = document.getElementById('alimentoadd');

	if($('#alimentoadd').hasClass('active')){
        ventanaAdd.classList.remove('active');
    }else{
        ventanaAdd.classList.add('active');
    }
}


