$("#apagar").on('click', function() {
    $('input[type="checkbox"]:checked').each(function(){
        console.debug('ta caindo seu bosta');
        apagaRegistrosChecked($(this).val());
    });
    $("#modalapagar").html('Visitante removido com sucesso!');
    setTimeout(function() {
        $("#confirmacaoExclusao").modal("hide");
    }, 1500);
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

