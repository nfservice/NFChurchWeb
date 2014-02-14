<?php echo $this->Html->script(array('jquery', 'js')); ?>
<script>
  var cont;
  function addParente(){    
    cont = $('#parente').children().last().attr('id');
    cont++;
    membro = $('#Relacionamento0Membro2Id').parent().clone().html();
    membro = membro.replaceAll('Relacionamento0Membro2Id','Relacionamento'+cont+'Membro2Id').replaceAll('data[Relacionamento][0][membro2_id]','data[Relacionamento]['+ cont+'][membro2_id]');
    relacionamento = $('#Relacionamento0TiporelacionamentoId').parent().clone().html();
    relacionamento = relacionamento.replaceAll('Relacionamento0TiporelacionamentoId','Relacionamento'+cont+'TiporelacionamentoId').replaceAll('data[Relacionamento][0][tiporelacionamento_id]','data[Relacionamento]['+ cont+'][tiporelacionamento_id]');
    $('#parente').append('<div id="'+cont+'"><input type="hidden" name="data[Relacionamento]['+cont+'][membro_id]" id="Relacionamento'+cont+'PessoaId" value="<?php echo $this->request->data['Membro']['id'] ?>"><div class="form-group col-md-8">'+membro+'</div><div class="form-group col-md-2">'+relacionamento+'</div><a href="javascript:;" onclick="removeParente('+cont+')"><span class="glyphicon glyphicon-remove">Remover</span></a></div>');
  }

  function removeParente(id){
      $("#parente"+id).remove();
  }

  $(document).ready(function(){

  });
</script>

<ol class="breadcrumb"><!-- breadcrumb -->
  <li><a href="#">Início</a></li>
  <li><a href="#">Secretaria</a></li>
  <li><a href="#">Gerenciar Membros</a></li>
  <li class="active">Cadastro de Membro</li>
</ol><!-- /breadcrumb -->
<h2>Cadastro de Membro</h2>
<!-- form -->
<?php echo $this->Form->create('Membro', array('role' => 'form')); 
  //echo $this->Form->input('tipo_id', array('label' => 'Tipo de Membro' ,'class' => 'form-control', 'required', 'div' => array('class' => 'form-group col-md-4'), 'options' => array('0' => 'Selecione', '1' => 'Membro', '2' => 'Visitante', '3' => 'Parente')));
  echo $this->Form->unput('id', array('type' => 'hidden', 'value' => $this->request->data['Membro']['id']));
  echo $this->Form->input('datamembro', array('type' => 'text', 'label' => 'Tornou-se Membro em:' ,'class' => 'form-control datepicker', 'required', 'div' => array('class' => 'form-group col-md-4'), 'data-date-format' => 'dd/mm/yyyy')); 
  echo $this->Form->input('nome', array('label' => 'Nome da Membro' ,'placeholder' => 'Nome da Membro', 'class' => 'form-control', 'required', 'div' => array('class' => 'form-group col-md-8')));
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

  echo $this->Form->input('rg', array('label' => 'RG' ,'placeholder' => '00.000.000-0', 'class' => 'form-control col-md-3', 'required', 'div' => array('class' => 'form-group col-md-4')));
  echo $this->Form->input('cpf', array('label' => 'CPF' ,'placeholder' => '000.000.000-00', 'class' => 'form-control col-md-3', 'required', 'div' => array('class' => 'form-group col-md-4')));

  echo $this->Form->input('fone', array('label' => 'Telefone', 'class' => 'form-control', 'required', 'div' => array('class' => 'form-group col-md-4')));
  echo $this->Form->input('cel', array('label' => 'Celular', 'class' => 'form-control', 'required', 'div' => array('class' => 'form-group col-md-4')));

  echo $this->Form->input('escolaridade', array('label' => 'Escolaridade' ,'class' => 'form-control', 'required', 'div' => array('class' => 'form-group col-md-4'), 'options' => array('0' => 'Selecione', '1' => 'Ensino Superior', '2' => 'Ensino Médio Completo', '3' => 'Ensino Médio Incompleto', '4' => 'Ensino Fundamental Completo', '5' => 'Ensino Fundamental Incompleto'))); 
  echo $this->Form->input('tipo', array('type' => 'hidden', 'value' => '0'));
?>
  <div id="parente">
    <?php
      $i = 0;
      foreach ($this->request->data['Relacionamento'] as $relacionamento) { ?>
        <div id="<?php echo $i ?>">
        <?php echo $this->Form->input('Relacionamento.'.$i.'.id', array('type' => 'hidden', 'value' => $relacionamento['id']));
        echo $this->Form->input('Relacionamento.'.$i.'.membro2_id', array('label' => 'Parente', 'class' => 'form-control', 'placeholder' => 'Nome Parente', 'required', 'div' => array('class' => 'form-group col-md-8'), 'options' => $parentes, 'default' => $relacionamento['membro2_id']));
        echo $this->Form->input('Relacionamento.'.$i.'.tiporelacionamento_id', array('label' => 'Tipo:', 'class' => 'form-control', 'required', 'div' => array('class' => 'form-group col-md-2'), 'options' => $relacionamentos, 'default' => $relacionamento['tiporelacionamento_id']));
        $i++; ?>
        </div>
      <?php } ?>
  </div>
  
  <div class="form-group col-md-1" style="margin-top:1.5em; padding-right:3em;">
    <a href="javascript:;" onclick="addParente()"><span class="glyphicon glyphicon-plus">Adicionar</span></a>
  </div>
  
  <?php
  echo $this->Form->input('profissao_id', array('label' => 'Profissão', 'id' => 'autocomplete', 'class' => 'form-control col-md-6', 'required', 'options' => $profissoes, 'div' => array('class' => 'form-group col-md-6')));
  echo $this->Form->input('empresa', array('label' => 'Empresa', 'class' => 'form-control col-md-6', 'required', 'div' => array('class' => 'form-group col-md-6')));

  echo $this->Form->input('databatismo', array('type' => 'text', 'label' => 'Data de Batismo', 'class' => 'form-control col-md-2 datepicker', 'required', 'div' => array('class' => 'form-group col-md-2', 'style' => 'border-bottom:3px !important;')));
  echo $this->Form->input('igrejabatismo', array('label' => 'Igreja Batismo', 'class' => 'form-control col-md-6', 'placeholder' => 'Nome da igreja que foi batizado', 'required', 'div' => array('class' => 'form-group col-md-5')));
  echo $this->Form->input('pastorbatismo', array('label' => 'Pastor que Batizou', 'class' => 'form-control col-md-6', 'placeholder' => 'Nome do Pastor que batizou', 'required', 'div' => array('class' => 'form-group col-md-5')));

  echo $this->Form->input('ultimaigreja', array('label' => 'Ultima Igreja que frequentou', 'class' => 'form-control col-md-6', 'placeholder' => 'Nome da Igreja que Frequentou', 'required', 'div' => array('class' => 'form-group col-md-6')));

  echo $this->Form->input('cargo_id', array('label' => 'Cargo na Igreja', 'class' => 'form-control col-md-6', 'placeholder' => 'Cargo que tinha na Igreja', 'required', 'options' => $cargos, 'div' => array('class' => 'form-group col-md-6')));

  echo $this->Form->input('igrejasanteriores', array('label' => 'Igrejas que já frequentou', 'class' => 'form-control', 'placeholder' => 'Nome das igrejas que já frequentou (pulando linhas)', 'required', 'div' => array('class' => 'form-group', 'style' => 'padding: 0 1em')));
?>
  <div class="form-group col-md-6">
    <button type="submit" class="btn btn-primary">Salvar</button>
    <?php echo $this->Form->input($this->Html->link('Voltar', array('plugin' => 'secretaria', 'controller' => 'membros', 'action' => 'index')), array('type' => 'button', 'label' => false)); ?>
  </div>
<?php echo $this->Form->end(); ?>
<!-- /form -->