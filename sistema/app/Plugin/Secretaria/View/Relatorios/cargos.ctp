<div class="col-lg-12">
	<section class="panel">
		<header class="panel-heading">
            Relatório de Cargos
        </header>
        <div class="panel-body">
			<?php
				echo $this->Form->create('Cargos');
				echo $this->Form->input('Gerar Relatório', array('type' => 'submit', 'label' => false, 'class' => 'form-control btn btn-success', 'div' => array('class' => ' col-md-3 form-group')));
				echo $this->Form->end();
			?>
		</div>
	</section>
</div>