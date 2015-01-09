<div class="col-lg-12">
	<section class="panel">
		<header class="panel-heading">
			Relatório de Items da Biblioteca
		</header>
		<div class="panel-body">
			<?php 
				echo $this->Form->create('Relatorio', array('role' => 'form', 'class' => 'formModal', 'target' => '_blank'));

                echo $this->Form->input('titulo', array('class' => 'form-control', 'label' => 'Nome:', 'div' => array('class' => 'form-group col-md-4')));
				echo $this->Form->input('tipo', array('empty' => 'Nenhum', 'class' => 'form-control', 'label' => 'Tipo:', 'div' => array('class' => 'form-group col-md-4')));
				echo $this->Form->input('categoria', array('empty' => 'Nenhum', 'class' => 'form-control', 'label' => 'Categoria:', 'div' => array('class' => 'form-group col-md-4')));
				echo $this->Form->input('autor', array('options' => $autores, 'empty' => 'Nenhum', 'class' => 'form-control', 'label' => 'Autor:', 'div' => array('class' => 'form-group col-md-4')));
                echo $this->Form->input('editora', array('empty' => 'Nenhum', 'class' => 'form-control', 'label' => 'Editora:', 'div' => array('class' => 'form-group col-md-4')));

				echo $this->Form->input('Gerar Relatório', array('type' => 'submit', 'label' => false, 'class' => 'btn btn-success form-control', 'div' => array('class' => 'form-group col-md-4', 'style' => 'float:none'), 'id' => 'salvar_dados')); 
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
	})
</script>