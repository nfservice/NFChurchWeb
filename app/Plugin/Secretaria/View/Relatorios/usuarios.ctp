<div class="col-lg-12">
    <section class="panel">
        <header class="panel-heading">
            Relatório de Usuários
        </header>
        <div class="panel-body">
        	<?php 
				echo $this->Form->create('Relatorio', array('role' => 'form', 'class' => 'formModal'));

				echo $this->Form->input('username', array('class' => 'form-control', 'label' => 'Usuário:', 'div' => array('class' => 'form-group col-md-6')));
				echo $this->Form->input('nome', array('class' => 'form-control', 'label' => 'Nome:', 'div' => array('class' => 'form-group col-md-6')));
				echo $this->Form->input('telefone', array('class' => 'form-control', 'label' => 'Telefone:', 'div' => array('class' => 'form-group col-md-4')));
				echo $this->Form->input('de', array('class' => 'form-control datepicker', 'label' => 'Cadastrado de:', 'div' => array('class' => 'form-group col-md-4')));
				echo $this->Form->input('ate', array('class' => 'form-control datepicker', 'label' => 'Cadastrado até:', 'div' => array('class' => 'form-group col-md-4')));
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