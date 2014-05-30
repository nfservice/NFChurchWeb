$("#apagar").on('click', function() {
    $('input[type="checkbox"]:checked').each(function(){
        apagaRegistrosChecked($(this).val());
    });
    $("#modalapagar").html('Visitante removido com sucesso!');
    setTimeout(function() {
        $("#confirmacaoExclusao").modal("hide");
    }, 1000);
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

