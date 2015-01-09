<div class="col-lg-12">
	<section class="panel">
		<header class="panel-heading">
			Relatório de Items da Biblioteca
		</header>
		<div class="panel-body">
			<?php 
				echo $this->Form->create('Relatorio', array('role' => 'form', 'class' => 'formModal', 'target' => '_blank'));

                echo $this->Form->input('nome', array('class' => 'form-control', 'label' => 'Nome:', 'div' => array('class' => 'form-group col-md-4')));
				echo $this->Form->input('num_ativo', array('empty' => 'Nenhum', 'class' => 'form-control', 'label' => 'Num. Ativo:', 'div' => array('class' => 'form-group col-md-4')));
				echo $this->Form->input('tipo_bem_id', array('empty' => 'Nenhum', 'options' => $tipo, 'class' => 'form-control', 'label' => 'Tipo:', 'div' => array('class' => 'form-group col-md-4')));
				echo $this->Form->input('congregacao_id', array('empty' => 'Nenhum', 'options' => $congregacao, 'class' => 'form-control', 'label' => 'Congregação:', 'div' => array('class' => 'form-group col-md-4')));
                echo $this->Form->input('data_compra', array('id' => 'date', 'class' => 'form-control', 'label' => 'Data de Compra:', 'div' => array('class' => 'form-group col-md-4')));

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