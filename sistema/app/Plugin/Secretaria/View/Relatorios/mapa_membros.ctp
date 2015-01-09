<div class="col-lg-12">
    <section class="panel">
        <header class="panel-heading">
            Mapa
        </header>
        <div class="panel-body">
        	<?php 
				echo $this->Form->create('Relatorio', array('role' => 'form', 'class' => 'formModal', 'target' => '_blank'));

				$options = array('1' => 'Sim', '0' => 'Não');
				echo $this->Form->input('ativo', array('class' => 'form-control', 'label' => 'Somente ativos:', 'options' => $options, 'div' => array('class' => 'form-group col-md-12')));
				echo $this->Form->input('Gerar Mapa', array('type' => 'submit', 'label' => false, 'class' => 'btn btn-success form-control', 'div' => array('class' => 'form-group col-md-12'), 'id' => 'salvar_dados')); 
			?>
        </div>
    </section>
</div>