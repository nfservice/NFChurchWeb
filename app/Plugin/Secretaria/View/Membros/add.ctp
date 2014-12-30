<script type="text/javascript">
    var cont = 0;
    function addParente() {
        //cont = $('#parente').children().last().attr('id');
        console.debug(cont);
        cont++;
        var membro = $('#Relacionamento0Membro2Id').parent().clone().html();
        var membro = membro.replaceAll('Relacionamento0Membro2Id','Relacionamento'+cont+'Membro2Id').replaceAll('data[Relacionamento][0][membro2_id]','data[Relacionamento]['+ cont+'][membro2_id]');
        var relacionamento = $('#Relacionamento0TiporelacionamentoId').parent().clone().html();
        var relacionamento = relacionamento.replaceAll('Relacionamento0TiporelacionamentoId','Relacionamento'+cont+'TiporelacionamentoId').replaceAll('data[Relacionamento][0][tiporelacionamento_id]','data[Relacionamento]['+ cont+'][tiporelacionamento_id]');
        
        $('#parente').append('<div id="'+cont+'"><input type="hidden" name="data[Relacionamento]['+cont+'][membro_id]" id="Relacionamento'+cont+'PessoaId" value=""><div class="form-group col-md-8">'+membro+'</div><div class="col-md-1 form-group"><a href="javascript:;" class="form-control btn btn-primary" onclick="modalLoadAdd(\'<?php echo $this->Html->url(array("plugin" => "secretaria", "controller" => "visitantes", "action" => "add")); ?>\', \'Relacionamento'+cont+'Membro2Id\', \'Relacionamento0Membro2Id\');" data-toggle="tooltip" data-placement="top" title="Adicionar Parente" style="margin-top:22px;" role="button"><i class="fa fa-plus"></i></a></div><div class="form-group col-md-2">'+relacionamento+'</div><div class="col-md-1" style="margin-top: 22px !important"><a href="javascript:;" onclick="removeParente('+cont+')" class="btn btn-danger form-control"><i class="fa fa-trash-o"></i></a></div></div>');
    }
</script> 



<div class="col-md-12">
    <!-- form -->
    <?php echo $this->Form->create('Membro', array('role' => 'form', 'class' => 'formModal')); 
        //echo $this->Form->input('tipo_id', array('label' => 'Tipo de Membro' ,'class' => 'form-control', 'required', 'div' => array('class' => 'form-group col-md-4'), 'options' => array('0' => 'Selecione', '1' => 'Membro', '2' => 'Visitante', '3' => 'Parente')));
        echo $this->Form->input('datamembro', array('type' => 'text', 'label' => 'Tornou-se Membro em:' ,'class' => 'form-control datepicker', 'required', 'div' => array('class' => 'form-group col-md-4'), 'data-date-format' => 'dd/mm/yyyy')); 
        echo $this->Form->input('nome', array('label' => 'Nome do Membro' ,'placeholder' => 'Nome do Membro', 'class' => 'form-control', 'required', 'div' => array('class' => 'form-group col-md-8')));
        echo $this->Form->input('email', array('label' => 'Email Pessoal' ,'placeholder' => 'Entre com seu email', 'class' => 'form-control', 'required', 'div' => array('class' => 'form-group col-md-9')));
        echo $this->Form->input('sexo', array('label' => 'Sexo' ,'class' => 'form-control', 'required', 'div' => array('class' => 'form-group col-md-3'), 'options' => array('0' => 'Selecione', '1' => 'Masculino', '2' => 'Feminino')));
    ?>
    <div class="nascimento">
    <?php 
        echo $this->Form->input('datanascimento', array('type' => 'text', 'label' => 'Data de Nascimento' ,'class' => 'form-control datepicker', 'required', 'div' => array('class' => 'form-group col-md-4'), 'data-date-format' => 'dd/mm/yyyy')); 

        echo $this->Form->input('estado_id', array('label' => 'Estado' ,'class' => 'form-control', 'required', 'div' => array('class' => 'form-group col-md-4'), 'options' => array($estados)));
        echo $this->Form->input('naturalidade', array('label' => 'Naturalidade' ,'placeholder' => 'Ex: Brasileiro', 'class' => 'form-control', 'required', 'div' => array('class' => 'form-group col-md-4')));
    ?>
    </div>
    <?php
        echo $this->Form->input('estadocivil', array('label' => 'Estado Civil' ,'class' => 'form-control', 'required', 'div' => array('class' => 'form-group col-md-4'), 'options' => array('0' => 'Solteiro', '1' => 'Casado', '2' => 'Viuvo', '3' => 'Desquitado'))); 

        echo $this->Form->input('rg', array('label' => 'RG' ,'placeholder' => '00.000.000-0', 'class' => 'form-control', 'required', 'div' => array('class' => 'form-group col-md-4')));
        echo $this->Form->input('cpf', array('label' => 'CPF' ,'placeholder' => '000.000.000-00', 'class' => 'form-control', 'required', 'div' => array('class' => 'form-group col-md-4')));

        echo $this->Form->input('fone', array('label' => 'Telefone', 'class' => 'form-control', 'required', 'div' => array('class' => 'form-group col-md-4')));
        echo $this->Form->input('cel', array('label' => 'Celular', 'class' => 'form-control', 'required', 'div' => array('class' => 'form-group col-md-4')));

        echo $this->Form->input('escolaridade_id', array('label' => 'Escolaridade' ,'class' => 'form-control', 'required', 'div' => array('class' => 'form-group col-md-4'), 'options' => $escolaridades)); 
        echo $this->Form->input('tipo', array('type' => 'hidden', 'value' => '0'));
    ?> 
    <div id="parente">
    <?php
        echo $this->Form->input('Relacionamento.0.membro_id', array('type' => 'hidden'));
        echo $this->Form->input('Relacionamento.0.membro2_id', array('label' => 'Parente', 'empty' => 'Selecione um membro', 'class' => 'form-control', 'placeholder' => 'Nome Parente', 'required', 'div' => array('class' => 'form-group col-md-8'), 'options' => $parentes));
        echo $this->Form->input('Relacionamento.0.tiporelacionamento_id', array('label' => 'Tipo:', 'empty' => 'Relacionamento', 'class' => 'form-control', 'required', 'div' => array('class' => 'form-group col-md-4'), 'options' => $relacionamentos));
    ?>
    </div>
  
    <div class="form-group col-md-11">
        <a href="javascript:;" onclick="addParente()" class="btn btn-primary form-control"><i class="fa fa-plus" role="button"></i> Adicionar Parente</a>
    </div>
  
    <?php
        echo $this->Form->input('profissao_id', array('label' => 'Profissão', 'id' => 'autocomplete', 'class' => 'form-control', 'required', 'options' => $profissoes, 'div' => array('class' => 'form-group col-md-5')));
    ?>
        <div class="form-group col-md-1">
            <a href="javascript:;" class="form-control btn btn-primary" onclick="modalLoadAdd('<?php echo $this->Html->url(array("plugin" => "secretaria", "controller" => "profissaos", "action" => "add")); ?>', 'autocomplete', 'autocomplete');" data-toggle="tooltip" data-placement="top" title="Adicionar Profissão" style="margin-top:22px;" role="button"><i class="fa fa-plus"></i></a>
        </div>
    <?php
        echo $this->Form->input('empresa', array('label' => 'Empresa', 'class' => 'form-control', 'required', 'div' => array('class' => 'form-group col-md-6')));
        
        echo $this->Form->input('databatismo', array('type' => 'text', 'label' => 'Data de Batismo', 'class' => 'form-control datepicker', 'required', 'div' => array('class' => 'form-group col-md-3')));
        echo $this->Form->input('igrejabatismo', array('label' => 'Igreja Batismo', 'class' => 'form-control', 'placeholder' => 'Nome da igreja que foi batizado', 'required', 'div' => array('class' => 'form-group col-md-4')));
        echo $this->Form->input('pastorbatismo', array('label' => 'Pastor que Batizou', 'class' => 'form-control', 'placeholder' => 'Nome do Pastor que batizou', 'required', 'div' => array('class' => 'form-group col-md-5')));

        echo $this->Form->input('ultimaigreja', array('label' => 'Ultima Igreja que frequentou', 'class' => 'form-control', 'placeholder' => 'Nome da Igreja que Frequentou', 'required', 'div' => array('class' => 'form-group col-md-11')));

        //echo $this->Form->input('MembroCargo.0.cargo_id', array('label' => 'Cargo na Igreja', 'class' => 'form-control', 'placeholder' => 'Cargo que tinha na Igreja', 'required', 'options' => $cargos, 'div' => array('class' => 'form-group col-md-6')));

        echo $this->Form->input('igrejasanteriores', array('label' => 'Igrejas que já frequentou', 'class' => 'form-control', 'placeholder' => 'Nome das igrejas que já frequentou (pulando linhas)', 'required', 'div' => array('class' => 'form-group', 'style' => 'padding: 0 1em')));
    ?>
    <div class="form-group col-md-2">
        <button data-dismiss="modal" class="btn btn-default form-control" type="button">Cancelar</button>
    </div>
    <?php
        //echo $this->Form->input($this->Html->link('Voltar', array('plugin' => 'secretaria', 'controller' => 'visitantes', 'action' => 'index')), array('type' => 'button', 'label' => false, 'class' => 'btn btn-cancel', 'div' => array('class' => 'form-group col-md-1')));
        echo $this->Form->input('Salvar Membro', array('type' => 'submit', 'label' => false, 'class' => 'btn btn-success form-control', 'div' => array('class' => 'form-group col-md-4')));
        
        echo $this->Form->end();
    ?>
</div>
