<div class="col-lg-12">
    <section class="panel">
        <header class="panel-heading">
            Relatório de Membros
        </header>
        <div class="panel-body">
        	<?php
				echo $this->Form->create('Relatorio', array('role' => 'form', 'class' => 'formModal'));

				echo '<div class="col-md-3 form-group input-group m-bot15">';
					echo $this->Form->input('datamembro', array('class' => 'form-control datepicker span2', 'label' => 'Tournou-se membro em:', 'div' => false));
					echo '<span class="input-group-btn"><button style="margin-top:23px" class="btn btn-danger" type="button" id="clearTornou"><i class="fa fa-times"></button></i></span>';
				echo '</div>';


				echo $this->Form->input('nome', array('class' => 'form-control', 'label' => 'Nome:', 'div' => array('class' => 'form-group col-md-5')));
				echo $this->Form->input('sexo', array('class' => 'form-control', 'label' => 'Sexo:', 'options' => array('' => 'Selecione', '1' => 'Masculino', '2' => 'Feminino'), 'div' => array('class' => 'form-group col-md-2')));
				echo $this->Form->input('tipo', array('class' => 'form-control', 'label' => 'Tipo:', 'options' => array('' => 'Selecione', '1' => 'Membro', '2' => 'Visitante'), 'div' => array('class' => 'form-group col-md-2')));
				echo $this->Form->input('estadocivil', array('class' => 'form-control', 'label' => 'Estado Civil:', 'options' => array('' => 'Selecione', '0' => 'Solteiro(a)', '1' => 'Casado(a)', '2' => 'Viuvo(a)', '3' => 'Divorciado(a)', '4' => 'Separado(a)', '5' => 'Companheiro(a)'), 'div' => array('class' => 'form-group col-md-2')));
				echo $this->Form->input('pastorbatismo', array('class' => 'form-control', 'label' => 'Pastor que Batizou:', 'div' => array('class' => 'form-group col-md-3')));
				echo $this->Form->input('escolaridade', array('class' => 'form-control', 'label' => 'Escolaridade:', 'options' => $escolaridades, 'empty' => 'Nenhuma', 'div' => array('class' => 'form-group col-md-4')));
				echo '<label style="margin-left:15px" for="RelatorioAniversariantes">Aniversariantes do mês:</label>';
				echo '<div class="col-md-3 form-group input-group m-bot15">';
					echo $this->Form->input('aniversariantes', array('class' => 'form-control aniv span2', 'label' => false, 'div' => false));
					echo '<span class="input-group-btn"><button class="btn btn-danger" type="button" id="clearAniv"><i class="fa fa-times"></button></i></span>';
				echo '</div>';

				echo $this->Form->input('Gerar Relatório', array('type' => 'submit', 'label' => false, 'class' => 'btn btn-success form-control', 'div' => array('class' => 'form-group col-md-4'), 'id' => 'salvar_dados'));
			?>
        </div>
    </section>
</div>
<script type="text/javascript">
	$(document).ready(function() {
		$(".datepicker").datepicker({
			clearBtn: true,
			format: "dd/mm/yyyy",
		});
		$(".aniv").datepicker({
			clearBtn: true,
			format: "mm/yyyy",
		    viewMode: "months",
			minViewMode: "months",
		});
		$('#clearAniv').on('click', function(){
			$('#RelatorioAniversariantes').val('').datepicker('update');
		});
		$('#clearTornou').on('click', function(){
			$('#RelatorioDatamembro').val('').datepicker('update');
		});
	});
</script>