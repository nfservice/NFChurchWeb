$(document).ready(function(){
	$('#ItemAssunto').keypress(function(e){		
		if (e.keyCode == 13) {
			Pace.restart();
			$.getJSON('searchItem/'+this.value, function(data){
				$('#itensTable tr.item').remove();

				$(data).each(function(i){
					var item = data[i];
					$('#itensTable').append(
						'<tr class="item">'+
							'<td>'+item.Item.titulo+' - '+item.Autor.nome+' ('+item.Tipo.nome+')</td>'+
							'<td>'+item.Item.estoque+'</td>'+
							'<td>'+
								'<button onclick="modalLoad(\'emprestar/'+item.Item.id+'\');" class="btn btn-primary">Empréstimo</button> '+
								'<button onclick="modalLoad(\'devolver/'+item.Item.id+'\');" class="btn btn-success">Devolução</button> '+
								'<button onclick="modalLoad(\'historico/'+item.Item.id+'\');" class="btn btn-warning">Histórico</button>'+
							'</td>'+
						'</tr>'
					);
				});
			});
			e.preventDefault();
		}
	});
});