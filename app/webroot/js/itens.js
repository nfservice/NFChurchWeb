$(document).ready(function(){
	$('#ItemAssunto').keypress(function(e){		
		if (e.keyCode == 13) {
			e.preventDefault();
			buscaItem();
		}
	});
});

function buscaItem(value) {
	Pace.restart();
	$.getJSON('searchItem/'+$('#ItemAssunto').val(), function(data){
		$('#itensTable tr.item').remove();

		$(data).each(function(i){
			var item = data[i];
			var line = '<tr class="item">'+
				'<td>'+item.Item.titulo+' - '+item.Autor.nome+' ('+item.Tipo.nome+')</td>'+
				'<td>'+item.Item.estoque+'</td>'+
				'<td>';

			if (item.Item.estoque > 0) {
				line += '<button onclick="modalLoad(\'emprestimo/'+item.Item.id+'\');" class="btn btn-primary">Empréstimo</button> ';
			}

			line += '<button onclick="modalLoad(\'devolucao/'+item.Item.id+'\');" class="btn btn-success">Devolução</button> '+
					'<button onclick="modalLoad(\'historico/'+item.Item.id+'\');" class="btn btn-warning">Histórico</button>'+
				'</td>'+
			'</tr>';

			$('#itensTable').append(line);
		});
	});	
}