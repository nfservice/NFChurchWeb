$("#apagar").on('click', function() {
	$("#confirmacaoExclusao").modal();
	var countremov = $('input[type="checkbox"]:checked').length-1;
    $('input[type="checkbox"]:checked').each(function(i){
        apagaRegistrosChecked($(this).val());

        if (i == countremov) {
        	$("#modalapagar").html('Registro removido com sucesso!');
    		$("#confirmacaoExclusao").modal("hide");
        }
    });   
});

function apagaRegistrosChecked(valor) {
	$.ajax(
    {
        url : urlApagaRegChecked+'/'+valor,
        type: "POST",
        success:function(data, textStatus, jqXHR) 
        {
            $("#dados_"+valor).remove();
        }
    });
}