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

function tornaRegistrosChecked(valor) {
	$.ajax(
    {
        url : urlTornarMembroRegChecked+'/'+valor,
        type: "POST",
        success:function(data, textStatus, jqXHR) 
        {
            $("#dados_"+valor).remove();
        }
    });
}