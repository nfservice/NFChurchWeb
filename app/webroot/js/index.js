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