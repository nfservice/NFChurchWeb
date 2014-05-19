$("#apagar").on('click', function() {
    $('input[type="checkbox"]:checked').each(function(){
        apagaRegistrosChecked($(this).val());
        $("#confirmacaoExclusao").modal("hide");
    });
    $("#modalapagar").html('Visitante removido com sucesso!');
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

