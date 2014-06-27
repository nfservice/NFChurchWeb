<h1>Congregações</h1>
<?php
	echo $this->Form->input($this->Html->link('Nova', array('plugin' => 'secretaria', 'controller' => 'congregacaos', 'action' => 'add')), array('type' => 'button', 'label' => false));
	echo $this->Form->input($this->Html->link('Deletar', array('plugin' => 'secretaria', 'controller' => 'congregacaos', 'action' => 'delete')), array('type' => 'button', 'label' => false));
	
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
					Nome:
				</th>
				<th>
					E-mail:
				</th>
				<th>
					Telefone:
				</th>
			</tr >
			<?php if (!empty($congregacaos)) {
				$i=0;
				foreach ($congregacaos as $congregacao) { ?>
					<tr class="tr-visitantes-click" onclick="ajaxload(<?php echo $this->Html->url('/'); ?>);">
						<td>
							<?php echo $this->Form->checkbox('set-'.$congregacao['Congregacao']['id'], array('hiddenField' => false, 'class' => 'toDelete', 'value' => $congregacao['Congregacao']['id'])); ?>
						</td>
						<td>
							<?php echo $congregacao['Congregacao']['nome']; ?>
						</td>
						<td>

							<?php
							$congregacao['Congregacao']['telefone'] = '('.substr($congregacao['Congregacao']['telefone'], 0, 2).') '.substr($congregacao['Congregacao']['telefone'], 2, -4).'-'.substr($congregacao['Congregacao']['telefone'], -4);
							echo $congregacao['Congregacao']['telefone']; ?>
						</td>
						<td>
							<?php echo $this->Html->link('Editar', array('action' => 'edit', $congregacao['Congregacao']['id'])); ?>
						</td>
					</tr>
					<?php $i++;
				}
			} else { ?>
				<tr>
					<td cellspacing="100%" cellpadding="100%" colspan="3" align="center">
						<?php echo "Você Ainda Não Cadastrou Nenhuma Congregação!"; ?>
					</td>
				</tr>
			<?php } ?>
		</table>
		<input type="submit" value="apagar todos selecionados">
	<?php echo $this->Form->end(); ?>