<h1>Dons</h1>
<?php
	echo $this->Form->input($this->Html->link('Novo', array('plugin' => 'secretaria', 'controller' => 'dons', 'action' => 'add')), array('type' => 'button', 'label' => false));
	echo $this->Form->input($this->Html->link('Deletar', array('plugin' => 'secretaria', 'controller' => 'dons', 'action' => 'delete')), array('type' => 'button', 'label' => false));
	
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
			<?php if (!empty($dons)) {
				$i=0;
				foreach ($dons as $don) { ?>
					<tr class="tr-visitantes-click" onclick="ajaxload(<?php echo $this->Html->url('/'); ?>);">
						<td>
							<?php echo $this->Form->checkbox('set-'.$don['Don']['id'], array('hiddenField' => false, 'class' => 'toDelete', 'value' => $don['Don']['id'])); ?>
						</td>
						<td>
							<?php echo $don['Don']['nome']; ?>
						</td>
					</tr>
					<?php $i++;
				}
			} else { ?>
				<tr>
					<td cellspacing="100%" cellpadding="100%" colspan="3" align="center">
						<?php echo "Você ainda não cadastrou nenhum Dom!"; ?>
					</td>
				</tr>
			<?php } ?>
		</table>
		<input type="submit" value="apagar todos selecionados">
	<?php echo $this->Form->end(); ?>