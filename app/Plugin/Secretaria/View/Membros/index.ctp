<h1>Membros</h1>
<div>
	<h3>
		<?php echo $this->Html->link('Novo Membro', array('plugin' => 'secretaria', 'controller' => 'membros', 'action' => 'add')); ?>
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
	<?php foreach ($membros as $membro) { ?>
		<tr>
			<td>
				<?php echo $membro['Membro']['nome']; ?>
			</td>
			<td>
				<?php echo $membro['Membro']['cpf']; ?>
			</td>
			<td>
				<?php echo $membro['Membro']['fone']; ?>
			</td>
			<td>
				<?php echo $membro['Membro']['email']; ?>
			</td>
			<td>
				<?php echo $this->Html->link('Editar', array('plugin' => 'secretaria', 'controller' => 'membros', 'action' => 'edit', $membro['Membro']['id'])); ?>
				&nbsp;
				<?php echo $this->Html->link('Visualizar', array('plugin' => 'secretaria', 'controller' => 'membros', 'action' => 'view', $membro['Membro']['id'])); ?>
				&nbsp;
				<?php echo $this->Form->postLink('Deletar', array('action' => 'delete', $membro['Membro']['id']), null, __('Deseja deletar a Membro %s?', $membro['Membro']['nome'])); ?>
			</td>
		</tr>
	<?php } ?>
</table>