<div class="col-lg-12">
    <section class="panel">
        <header class="panel-heading">
            Relatório de Visitantes
        </header>
        <div class="panel-body">
        	<?php 
				echo $this->Form->create('Relatorio', array('role' => 'form', 'class' => 'formModal'));

				echo $this->Form->input('nome', array('class' => 'form-control', 'label' => 'Nome:', 'div' => array('class' => 'form-group col-md-9')));
				echo $this->Form->input('sexo', array('class' => 'form-control', 'label' => 'Sexo:', 'options' => array('' => 'Selecione', '0' => 'Masculino', '1' => 'Feminino',), 'div' => array('class' => 'form-group col-md-3')));
				echo $this->Form->input('estadocivil', array('class' => 'form-control', 'label' => 'Estado Civil:', 'options' => array('' => 'Todos', '0' => 'Solteiro', '1' => 'Casado', '2' => 'Viúvo', '3' => 'Desquitado'), 'div' => array('class' => 'form-group col-md-4')));
				echo $this->Form->input('escolaridade', array('class' => 'form-control', 'label' => 'Escolaridade:', 'options' => $escolaridades, 'empty' => 'Todas', 'div' => array('class' => 'form-group col-md-6')));
				
				echo $this->Form->input('Gerar Relatório', array('type' => 'submit', 'label' => false, 'class' => 'btn btn-success form-control', 'div' => array('class' => 'form-group col-md-4'), 'id' => 'salvar_dados'));
			?>
        </div>
    </section>
</div>
<script type="text/javascript">
	$(document).ready(function() {
		$(".datepicker").datepicker();
	});
</script>