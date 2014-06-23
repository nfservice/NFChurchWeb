$("#apagar").on('click', function() {
    $('input[type="checkbox"]:checked').each(function(){
        apagaRegistrosChecked($(this).val());
    });
    $("#modalapagar").html('Registro removido com sucesso!');
    $("#confirmacaoExclusao").modal("hide");
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

