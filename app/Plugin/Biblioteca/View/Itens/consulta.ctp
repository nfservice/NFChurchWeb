<?php echo $this->Html->script('itens.js'); ?>
<div class="col-lg-12">
	<section class="panel">
		<header class="panel-heading">
			Biblioteca - Consulta
		</header>
		<div class="panel-body">
			<?php 
				echo $this->Form->create('Item', array('role' => 'form', 'class' => 'formModal'));
					echo $this->Form->input('assunto', array('class' => 'form-control input-lg', 'autocomplete' => 'off', 'label' => false, 'placeholder' => 'Item a ser pesquisado...', 'div' => array('class' => 'form-group col-md-12')));
				echo $this->Form->end();
			?>

			<div class="col-md-12">
				<table class="table table-bordered" id="itensTable">
					<tr>
						<th>Título</th>
						<th>Disponível</th>
						<th>Ações</th>
					</tr>
				</table>
			</div>
		</div>
	</section>
</div>

<?php echo $this->element('modal/modalEdit'); ?>