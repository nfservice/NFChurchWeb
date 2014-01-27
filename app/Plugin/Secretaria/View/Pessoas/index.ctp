<h1>Pessoas</h1>
<div>
	<h3>
		<?php echo $this->Html->link('Nova Pessoa', array('plugin' => 'secretaria', 'controller' => 'pessoas', 'action' => 'add')); ?>
	</h3>
</div>
<table>
	<tr>
		<th>
			Nome:
		</th>
		<th>
			CPF:
		</th>
		<th>
			Telefone:
		</th>
		<th>
			Email:
		</th>
		<th>
			Ações:
		</th>
	</tr>
	<?php foreach ($pessoas as $pessoa) { ?>
		<tr>
			<td>
				<?php echo $pessoa['Pessoa']['nome']; ?>
			</td>
			<td>
				<?php echo $pessoa['Pessoa']['cpf']; ?>
			</td>
			<td>
				<?php echo $pessoa['Pessoa']['fone']; ?>
			</td>
			<td>
				<?php echo $pessoa['Pessoa']['email']; ?>
			</td>
			<td>
				<?php echo $this->Html->link('Editar', array('plugin' => 'secretaria', 'controller' => 'pessoas', 'action' => 'edit', $pessoa['Pessoa']['id'])); ?>
				&nbsp;
				<?php echo $this->Html->link('Visualizar', array('plugin' => 'secretaria', 'controller' => 'pessoas', 'action' => 'view', $pessoa['Pessoa']['id'])); ?>
				&nbsp;
				<?php echo $this->Form->postLink('Deletar', array('action' => 'delete', $pessoa['Pessoa']['id']), null, __('Deseja deletar a Pessoa %s?', $pessoa['Pessoa']['nome'])); ?>
			</td>
		</tr>
	<?php } ?>
</table>