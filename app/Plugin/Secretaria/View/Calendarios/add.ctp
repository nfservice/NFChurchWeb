<h1>Novo Evento</h1>
<?php
    echo $this->Form->create('Calendario');

    echo '<div class="row col-md-12 form-group">';

    echo $this->Form->input('assunto', array('label' => ' Assunto: ', 'required', 'class' => 'form-control', 'div' => array('class' => 'col-md-12')));

    echo '</div>';

    echo '<div class="row col-md-12 form-group">';

    echo $this->Form->input('diatodo', array('label' => ' Fim Previsto: ', 'options' => array('0' => 'Sim', '1' => 'Não') , 'class' => 'form-control', 'div' => array('class' => 'col-md-2')));

    echo $this->Form->input('chirch_id', array('type' => 'hidden', 'value' => $this->Session->read('choosed')));
    echo $this->Form->input('id', array('type' => 'hidden'));

    echo $this->Form->input('datainicio', array('label' => 'Inicio: ', 'required', 'type' => 'text', 'class' => 'date form-control datetimepicker', 'div' => array('class' => 'col-md-3')));
    echo $this->Form->input('datafim', array('label' => 'Fim: ', 'type' => 'text', 'class' => 'date form-control datetimepicker', 'div' => array('class' => 'col-md-3')));
    
?>
    <div class="col-md-2 pull-right">
        <label for="color">Cor:</label>
        <div class="input-group" id="color" data-color>
            <?php echo $this->Form->input('cor', array('label' => false, 'div' => false, 'class' => "form-control")) ?>
            <span class="input-group-addon"><i></i></span>
        </div>
    </div>
</div>
<div class="row col-md-12 form-group">
    <?php
        echo $this->Form->input('descricao', array('label' => 'Descrição do Evento: ', 'required', 'class' => 'form-control', 'div' => array('class' => 'col-md-12')));
    ?>    
</div>
<div class="row col-md-12 form-group">
    <div class="submit">
        <input class="btn btn-success form-control" type="submit" value="Gravar Evento">
    </div>
</div>
<?php
	echo $this->Form->end();
?>
<script type="text/javascript" charset="UTF-8">
    $(document).ready(function(){
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
        $('#CalendarioDiatodo').change(function(){
            if (this.value == 1) {
                $('#CalendarioDatafim').hide();
                $('label[for="CalendarioDatafim"]').hide().attr('disabled', 'disabled');
            } else {
                $('#CalendarioDatafim').show();
                $('label[for="CalendarioDatafim"]').show().removeAttr('disabled');
            }
        });
        $('#color').colorpicker({
            format: 'hex',
            color: '#032C40',
        });
    });
</script>