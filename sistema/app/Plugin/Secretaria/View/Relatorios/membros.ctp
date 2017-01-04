<div class="col-lg-12">
    <section class="panel">
        <header class="panel-heading">
            Relatório de Membros
        </header>
        <div class="panel-body">
        	<?php 
				echo $this->Form->create('Relatorio', array('role' => 'form', 'class' => 'formModal'));

				echo $this->Form->input('datamembro', array('class' => 'form-control datepicker', 'label' => 'Tournou-se membro em:', 'div' => array('class' => 'form-group col-md-3')));
				echo $this->Form->input('nome', array('class' => 'form-control', 'label' => 'Nome:', 'div' => array('class' => 'form-group col-md-5')));
				echo $this->Form->input('sexo', array('class' => 'form-control', 'label' => 'Sexo:', 'options' => array('' => 'Selecione', '1' => 'Masculino', '2' => 'Feminino'), 'div' => array('class' => 'form-group col-md-2')));
				echo $this->Form->input('tipo', array('class' => 'form-control', 'label' => 'Tipo:', 'options' => array('' => 'Selecione', '1' => 'Membro', '2' => 'Visitante'), 'div' => array('class' => 'form-group col-md-2')));
				echo $this->Form->input('estadocivil', array('class' => 'form-control', 'label' => 'Estado Civil:', 'options' => array('' => 'Selecione', '0' => 'Solteiro', '1' => 'Casado', '2' => 'Viúvo', '3' => 'Desquitado'), 'div' => array('class' => 'form-group col-md-4')));
				echo $this->Form->input('pastorbatismo', array('class' => 'form-control', 'label' => 'Pastor que Batizou:', 'div' => array('class' => 'form-group col-md-4')));
				echo $this->Form->input('escolaridade', array('class' => 'form-control', 'label' => 'Escolaridade:', 'options' => $escolaridades, 'empty' => 'Nenhuma', 'div' => array('class' => 'form-group col-md-4')));
				echo $this->Form->input('Gerar Relatório', array('type' => 'submit', 'label' => false, 'class' => 'btn btn-success form-control', 'div' => array('class' => 'form-group col-md-4'), 'id' => 'salvar_dados')); 
			?>
        </div>
    </section>
</div>
<script type="text/javascript">
	$(document).ready(function() {
		$(".datepicker").datepicker({
			format: "dd/mm/yyyy"
		});
	});
</script>