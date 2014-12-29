<div class="col-lg-12">
    <section class="panel">
        <header class="panel-heading">
            Relatório de Usuários
        </header>
        <div class="panel-body">
        	<?php 
				echo $this->Form->create('Congregacao', array('role' => 'form', 'class' => 'formModal'));

				echo $this->Form->input('nome', array('class' => 'form-control', 'label' => 'Nome:', 'div' => array('class' => 'form-group col-md-6')));
				echo $this->Form->input('bairro', array('class' => 'form-control', 'label' => 'Bairro:', 'div' => array('class' => 'form-group col-md-6')));
				echo $this->Form->input('cidade', array('class' => 'form-control', 'label' => 'Cidade:', 'div' => array('class' => 'form-group col-md-6')));
				echo $this->Form->input('estado', array('class' => 'form-control', 'label' => 'Estados:', 'options' => $estados, 'empty' => 'Todos', 'div' => array('class' => 'form-group col-md-6'))); 
				?>
					<?php 
						echo $this->Form->input('Gerar Relatório', array('type' => 'submit', 'label' => false, 'class' => 'btn btn-success form-control', 'div' => array('class' => 'form-group col-md-4'), 'id' => 'salvar_dados'));
					?>
        </div>
    </section>
</div>
<script type="text/javascript">
	$(document).ready(function() {
		$(".datepicker").datepicker();
	})
</script>