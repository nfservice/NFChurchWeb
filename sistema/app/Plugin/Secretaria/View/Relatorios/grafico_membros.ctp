<div class="col-lg-12">
    <section class="panel">
        <header class="panel-heading">
            Gráfico de Novos Membros
        </header>
        <div class="panel-body">
        	<?php 
				echo $this->Form->create('Relatorio', array('role' => 'form', 'class' => 'formModal'));

                echo $this->Form->input('data_de', array('class' => 'form-control datepicker', 'label' => 'Entrada de:', 'div' => array('class' => 'form-group col-md-2')));
                echo $this->Form->input('data_ate', array('class' => 'form-control datepicker', 'label' => 'Entrada até:', 'div' => array('class' => 'form-group col-md-2')));

				echo $this->Form->input('Gerar Gráfico', array('type' => 'submit', 'label' => false, 'class' => 'btn btn-success form-control', 'div' => array('class' => 'form-group col-md-12'), 'id' => 'salvar_dados')); 
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