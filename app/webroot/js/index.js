$( document ).ready(function() {
	$("#apagar").on('click', function() {
		$('input[type="checkbox"]:checked').each(function(){
			console.debug('eae');
		    apagaRegistrosChecked($(this).val());
		});             
	});
});

function apagaRegistrosChecked(valor) {
	$.ajax(
    {
        url : urlApagaRegChecked+'/'+valor,
        type: "POST",
        success:function(data, textStatus, jqXHR) 
        {
            alert('removeu o visitante '+valor);
        },
        error: function(jqXHR, textStatus, errorThrown) 
        {
            //if failss      
        }
    });
}