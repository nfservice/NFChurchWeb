<?php echo $this->Form->create('Calendario'); ?>

<div class="row col-md-12 form-group">
    <?php echo $this->Form->input('assunto', array('label' => ' Assunto: ', 'required', 'class' => 'form-control', 'div' => array('class' => 'col-md-12'))); ?>
</div>

<div class="row col-md-12 form-group">

    <?php
        echo $this->Form->input('diatodo', array('label' => ' Fim Previsto: ', 'options' => array('0' => 'Sim', '1' => 'Não') , 'class' => 'form-control', 'div' => array('class' => 'col-md-2')));

        echo $this->Form->input('chirch_id', array('type' => 'hidden', 'value' => $this->Session->read('choosed')));
        echo $this->Form->input('id', array('type' => 'hidden'));
        
        $this->request->data['Calendario']['datainicio'] = explode(' ', $this->request->data['Calendario']['datainicio']);
        $datainicio = implode('/', array_reverse(explode('-', $this->request->data['Calendario']['datainicio'][0])));
        $horainicio = substr($this->request->data['Calendario']['datainicio'][1], 0, 5);
        $this->request->data['Calendario']['datainicio'] = $datainicio.' '.$horainicio;
        

        $this->request->data['Calendario']['datafim'] = explode(' ', $this->request->data['Calendario']['datafim']);
        $datainicio = implode('/', array_reverse(explode('-', $this->request->data['Calendario']['datafim'][0])));
        $horainicio = substr($this->request->data['Calendario']['datafim'][1], 0, 5);
        $this->request->data['Calendario']['datafim'] = $datainicio.' '.$horainicio;


        echo $this->Form->input('datainicio', array('label' => 'Inicio: ', 'required', 'type' => 'text', 'class' => 'date form-control datetimepicker', 'div' => array('class' => 'col-md-3')));
    	if ($this->request->data['Calendario']['diatodo'] == 0) {
            echo $this->Form->input('datafim', array('label' => 'Fim: ', 'type' => 'text', 'class' => 'date form-control datetimepicker', 'div' => array('class' => 'col-md-3')));
        } else {
            echo $this->Form->input('datafim', array('label' => array('style' => 'display:none', 'text' => 'Fim: '), 'disabled', 'style' => 'display:none',  'type' => 'text', 'class' => 'date form-control datetimepicker', 'div' => array('class' => 'col-md-3')));
        }
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
    var diatodo = '<?php $this->request->data['Calendario']['diatodo'] ?>';
    var datainicio = '<?php echo $this->request->data['Calendario']['datainicio'] ?>';
    var datafim = '<?php echo $this->request->data['Calendario']['datafim'] ?>';
    var cor = '<?php echo $this->request->data['Calendario']['cor']; ?>';
    $(document).ready(function(){

        $.fn.datetimepicker.dates['br'] = {
            days: ["Domingo", "Segunda", "Terça", "Quarta", "Quinta", "Sexta", "Sabado", "Domingo"],
            daysShort: ["Dom", "Seg", "Ter", "Qua", "Qui", "Sex", "Sab", "Dom"],
            daysMin: ["Dom", "Seg", "Ter", "Qua", "Qui", "Sex", "Sab", "Dom"],
            months: ["Janeiro", "Fevereiro", "Março", "Abril", "Maio", "Junho", "Julho", "Agosto", "Setembro", "Outubro", "Novembro", "Dezembro"],
            monthsShort: ["Jan", "Fev", "Mar", "Abr", "Mai", "Jun", "Jul", "Ago", "Set", "Out", "Nov", "Dez"],
            today: "Hoje",
            meridiem: ["am", "pm"],
            defaultDate: "11/2/2013 13:54",
            //suffix: ["st", "nd", "rd", "th"],
        };
        $('#CalendarioDatainicio').datetimepicker(
            {
                rtl: true,
                language: 'br',
                format: 'dd/mm/yyyy hh:ii',
                autoclose: true,
                todayBtn:true,
                forceParse: 0,
                onRender: function(data){
                    console.debug(data);
                }
            }
        );

        $('#CalendarioDatafim').datetimepicker(
            {
                rtl: true,
                language: 'br',
                format: 'dd/mm/yyyy hh:ii',
                autoclose: true,
                todayBtn:true,
                forceParse: 0,
            }
        );

        //$(".datetimepicker").datetimepicker("setDate", new Date);
        //$(".datetimepicker").datetimepicker("setDate", new Date);

        

        $('#CalendarioDiatodo').change(function(){
            if (this.value == 1) {
                $('#CalendarioDatafim').hide().attr('disabled', 'disabled');
                $('label[for="CalendarioDatafim"]').hide();
            } else {
                $('#CalendarioDatafim').show().removeAttr('disabled');
                $('label[for="CalendarioDatafim"]').show();
            }
        });
        $('#color').attr('data-color', cor);
        $('#color').colorpicker({
            format: 'hex',
            color: cor,
        });
    });
</script>