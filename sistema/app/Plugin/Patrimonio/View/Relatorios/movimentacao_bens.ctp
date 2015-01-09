<div class="col-lg-12">
	<section class="panel">
		<header class="panel-heading">
			Relatório de Items da Biblioteca
		</header>
		<div class="panel-body">
			<?php 
				echo $this->Form->create('Relatorio', array('role' => 'form', 'class' => 'formModal', 'target' => '_blank'));
				echo $this->Form->input('bem_id', array('empty' => 'Selecione', 'options' => $bem, 'class' => 'form-control', 'label' => 'Bem:', 'div' => array('class' => 'form-group col-md-4')));
				echo $this->Form->input('Gerar Relatório', array('type' => 'submit', 'label' => false, 'class' => 'btn btn-success form-control', 'div' => array('class' => 'form-group col-md-4', 'style' => 'float:none'), 'id' => 'salvar_dados')); 
			?>
        </div>
    </section>
</div>
<script type="text/javascript">
	$(document).ready(function() {
        $('#date').datepicker();
	})
</script>