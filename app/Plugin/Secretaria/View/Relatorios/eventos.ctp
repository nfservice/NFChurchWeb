<div class="col-lg-12">
	<section class="panel">
		<header class="panel-heading">
			Relatório de Eventos
		</header>
		<div class="panel-body">
			<?php 
				echo $this->Form->create('Relatorio', array('role' => 'form', 'class' => 'formModal'));

				echo $this->Form->input('datainicio', array('class' => 'datetimepicker form-control', 'label' => 'Data Inicial:', 'div' => array('class' => 'form-group col-md-4')));
				echo $this->Form->input('datafim', array('class' => 'datetimepicker form-control', 'label' => 'Data Final:', 'div' => array('class' => 'form-group col-md-4')));
				echo $this->Form->input('assunto', array('class' => 'form-control', 'label' => 'Assunto:', 'div' => array('class' => 'form-group col-md-11')));
				echo $this->Form->input('Gerar Relatório', array('type' => 'submit', 'label' => false, 'class' => 'btn btn-success form-control', 'div' => array('class' => 'form-group col-md-4'), 'id' => 'salvar_dados')); 
			?>
        </div>
    </section>
</div>
<script type="text/javascript">
	$(document).ready(function() {
		$.fn.datetimepicker.dates['br'] = {
            days: ["Domingo", "Segunda", "Terça", "Quarta", "Quinta", "Sexta", "Sabado", "Domingo"],
            daysShort: ["Dom", "Seg", "Ter", "Qua", "Qui", "Sex", "Sab", "Dom"],
            daysMin: ["Dom", "Seg", "Ter", "Qua", "Qui", "Sex", "Sab", "Dom"],
            months: ["Janeiro", "Fevereiro", "Março", "Abril", "Maio", "Junho", "Julho", "Agosto", "Setembro", "Outubro", "Novembro", "Dezembro"],
            monthsShort: ["Jan", "Fev", "Mar", "Abr", "Mai", "Jun", "Jul", "Ago", "Set", "Out", "Nov", "Dez"],
            today: "Hoje",
            meridiem: ["am", "pm"],
            //suffix: ["st", "nd", "rd", "th"],
        };
        $('.datetimepicker').datetimepicker(
            {
                rtl: true,
                language: 'br',
                format: 'dd/mm/yyyy hh:ii',
                autoclose: true,
                todayBtn:true,
            }
        );
	});
</script>