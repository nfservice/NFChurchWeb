<div class="col-md-12">
	<h3>Movimentações - <strong><?php echo $item['Item']['titulo']; ?></strong></h3>
	<table class="table table-bordered">
		<tr>
			<th>Data</th>
			<th>Membro</th>
			<th>Quantidade</th>
			<th>Devolvido</th>
		</tr>
		<?php
			foreach ($historicos as $key => $historico) {
				$historico['MovimentacaoItem']['created'] = explode(' ', $historico['MovimentacaoItem']['created']);
				$historico['MovimentacaoItem']['created'] = implode('/', array_reverse(explode('-', $historico['MovimentacaoItem']['created'][0])));
		?>
			<tr>
				<td><?php echo $historico['MovimentacaoItem']['created']; ?></td>
				<td><?php echo $historico['Membro']['nome']; ?></td>
				<td><?php echo $historico['MovimentacaoItem']['quantidade']; ?></td>
				<td>
					<?php
						switch ($historico['MovimentacaoItem']['devolvido']) {
							case '1':
								$icon = '<i class="fa fa-check" style="color:green"></i>';
								break;
							default:
								$icon = '<i class="fa fa-remove" style="color:red"></i>';
								break;
						}

						echo $icon;
					?>
				</td>
			</tr>
		<?php
			}
		?>
	</table>
</div>