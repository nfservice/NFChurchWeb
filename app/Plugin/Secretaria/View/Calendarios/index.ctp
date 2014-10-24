<h1>Novo Evento</h1>
<?php
	echo $this->Form->input($this->Html->link('Novo', array('plugin' => 'secretaria', 'controller' => 'calendarios', 'action' => 'add')), array('type' => 'button', 'label' => false));
	echo $this->Form->input($this->Html->link('Deletar', array('plugin' => 'secretaria', 'controller' => 'calendarios', 'action' => 'delete')), array('type' => 'button', 'label' => false));
	
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
					Inicio:
				</th>
				<th>
					Término:
				</th>
				<th>
					Facebook:
				</th>
			</tr >
			<?php if (!empty($eventos)) {
				$i=0;
				foreach ($eventos as $evento) { ?>
					<tr class="tr-visitantes-click" onclick="ajaxload(<?php echo $this->Html->url('/'); ?>);">
						<td>
							<?php echo $this->Form->checkbox('set-'.$evento['Calendario']['id'], array('hiddenField' => false, 'class' => 'toDelete', 'value' => $evento['Calendario']['id'])); ?>
						</td>
						<td>
							<?php echo $evento['Calendario']['datainicio']; ?>
						</td>
						<td>
						<?php echo $evento['Calendario']['datafim']; ?>
						</td>
						<td>
							<?php echo $this->Html->link('Editar', array('action' => 'edit', $evento['Calendario']['id'])); ?>
						</td>
					</tr>
					<?php $i++;
				}
			} else { ?>
				<tr>
					<td cellspacing="100%" cellpadding="100%" colspan="3" align="center">
						<?php echo "Você Ainda Não Cadastrou Nenhum Evento!"; ?>
					</td>
				</tr>
			<?php } ?>
		</table>
		<input type="submit" value="apagar todos selecionados">
	<?php echo $this->Form->end(); ?>