<?php
	echo $this->Form->input($this->Html->link('Novo', array('plugin' => 'secretaria', 'controller' => 'tiporelacionamentos', 'action' => 'add')), array('type' => 'button', 'label' => false));
	echo $this->Form->input($this->Html->link('Deletar', array('plugin' => 'secretaria', 'controller' => 'tiporelacionamentos', 'action' => 'delete')), array('type' => 'button', 'label' => false));
	
	echo $this->Form->create(array('Pesquisa')); ?>
		<input type="text" size="50" id="texto" name="filtro" placeholder="Filtre aqui" class="form-control">
		<input type="submit" class="btn btn-success" type="button" value="Pesquisar!">
	<?php echo $this->Form->end(); ?>
					
	<?php echo $this->Form->create(null, array('action' => 'delete')); ?>
		<table class="table table-bordered table-striped table-condensed">
			<tr>
				<th>
					<!-- preparar função para selecionar todos os checkbox-->
					<?php echo $this->Form->checkbox('setAll', array('hiddenField' => false, 'class' => 'toDelete')); ?>
				</th>
				<th>
					Descrição:
				</th>
			</tr >
			<?php if (!empty($tiporelacionamentos)) {
				$i=0;
				foreach ($tiporelacionamentos as $tiporelacionamento) { ?>
					<tr class="tr-visitantes-click" onclick="ajaxload(<?php echo $this->Html->url('/'); ?>);">
						<td>
							<?php echo $this->Form->checkbox('set-'.$tiporelacionamento['Tiporelacionamento']['id'], array('hiddenField' => false, 'class' => 'toDelete', 'value' => $tiporelacionamento['Tiporelacionamento']['id'])); ?>
						</td>
						<td>
							<?php echo $tiporelacionamento['Tiporelacionamento']['descricao']; ?>
						</td>
					</tr>
					<?php $i++;
				}
			} else { ?>
				<tr>
					<td cellspacing="100%" cellpadding="100%" colspan="3" align="center">
						<?php echo "Você Ainda Não Cadastrou Nenhum Relacionamento"; ?>
					</td>
				</tr>
			<?php } ?>
		</table>
	<?php echo $this->Form->end(); ?>