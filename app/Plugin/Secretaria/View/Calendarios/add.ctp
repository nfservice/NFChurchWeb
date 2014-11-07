<h1>Novo Evento</h1>
<?php
	echo $this->Form->create('Calendario');

    echo $this->Form->input('diatodo', array('label' => ' Dia Inteiro ', 'options' => array('0' => 'Não', '1' => 'Sim') , 'class' => 'form-control', 'div' => array('class' => 'col-md-2')));

    echo $this->Form->input('datainicio', array('label' => 'Inicio: ', 'type' => 'text', 'class' => 'date form-control datetimepicker', 'div' => array('class' => 'col-md-2')));
	
    echo $this->Form->input('datafim', array('label' => 'Fim: ', 'type' => 'text', 'class' => 'date form-control datetimepicker', 'div' => array('class' => 'col-md-2')));

    echo $this->Form->input('descricao', array('label' => 'Descrição do Evento', 'class' => 'form-control', 'div' => array('class' => 'col-md-10')));
?>
    <div class="form-group">
        <label class="control-label col-md-3">Grouped Options</label>
        <div class="col-md-9">
            <select multiple="multiple" class="multi-select" id="my_multi_select2" name="my_multi_select2[]">
                <optgroup label="NFC EAST">
                    <option>Dallas Cowboys</option>
                    <option>New York Giants</option>
                    <option>Philadelphia Eagles</option>
                    <option>Washington Redskins</option>
                </optgroup>
                <optgroup label="NFC NORTH">
                    <option>Chicago Bears</option>
                    <option>Detroit Lions</option>
                    <option>Green Bay Packers</option>
                    <option>Minnesota Vikings</option>
                </optgroup>
                <optgroup label="NFC SOUTH">
                    <option>Atlanta Falcons</option>
                    <option>Carolina Panthers</option>
                    <option>New Orleans Saints</option>
                    <option>Tampa Bay Buccaneers</option>
                </optgroup>
                <optgroup label="NFC WEST">
                    <option>Arizona Cardinals</option>
                    <option>St. Louis Rams</option>
                    <option>San Francisco 49ers</option>
                    <option>Seattle Seahawks</option>
                </optgroup>
            </select>
        </div>
    </div>
<?php
	echo $this->Form->end();
?>
<script type="text/javascript">
    $(document).ready(function(){
        $('.datetimepicker').datetimepicker(
            {
                language: 'br',
            }
        );
    });
</script>