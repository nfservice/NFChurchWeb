<script>
    var cont;
    function addParente(){    
        cont = $('#parente').children().last().attr('id');
        cont++;
        membro = $('#Relacionamento0Membro2Id').parent().clone().html();
        membro = membro.replaceAll('Relacionamento0Membro2Id','Relacionamento'+cont+'Membro2Id').replaceAll('data[Relacionamento][0][membro2_id]','data[Relacionamento]['+ cont+'][membro2_id]');
        relacionamento = $('#Relacionamento0TiporelacionamentoId').parent().clone().html();
        relacionamento = relacionamento.replaceAll('Relacionamento0TiporelacionamentoId','Relacionamento'+cont+'TiporelacionamentoId').replaceAll('data[Relacionamento][0][tiporelacionamento_id]','data[Relacionamento]['+ cont+'][tiporelacionamento_id]');
        $('#parente').append('<div id="'+cont+'" class="col-md-12"><input type="hidden" name="data[Relacionamento]['+cont+'][membro_id]" id="Relacionamento'+cont+'PessoaId" value="<?php echo $this->request->data['Membro']['id'] ?>"><div class="form-group col-md-8">'+membro+'</div><div class="col-md-1 form-group"><a href="javascript:;" class="form-control btn btn-primary" onclick="modalLoadAdd(\'<?php echo $this->Html->url(array("plugin" => "secretaria", "controller" => "visitantes", "action" => "add")); ?>\', \'Relacionamento'+cont+'Membro2Id\', \'Relacionamento0Membro2Id\');" data-toggle="tooltip" data-placement="top" title="Adicionar Parente" style="margin-top:22px;" role="button"><i class="fa fa-plus"></i></a></div><div class="form-group col-md-2">'+relacionamento+'</div><div class="col-md-1" style="margin-top: 22px !important"><a href="javascript:;" onclick="removeParente('+cont+')" class="btn btn-danger form-control"><i class="fa fa-trash-o"></i></a></div></div>');
    }
</script> 

<div class="col-md-12">
<!-- form -->
    <?php echo $this->Form->create('Membro', array('role' => 'form', 'class' => 'desable-form formModal')); ?>
        <div class="col-md-12">
            <div class="alert alert-warning" id="msg_block">    
                <p><button type="button" class="btn btn-success habilita_campos" id="futuro-salvar"><i class="fa fa-unlock"></i></button> Clique no cadeado ao lado para desbloquear os campos do formulário</p>
            </div>
        </div>
        <?php
      
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

        echo $this->Form->input('rg', array('label' => 'RG' ,'placeholder' => '00.000.000-0', 'class' => 'form-control', 'required', 'div' => array('class' => 'form-group col-md-4')));
        echo $this->Form->input('cpf', array('label' => 'CPF' ,'placeholder' => '000.000.000-00', 'class' => 'form-control', 'required', 'div' => array('class' => 'form-group col-md-4')));

        echo $this->Form->input('fone', array('label' => 'Telefone', 'class' => 'form-control', 'required', 'div' => array('class' => 'form-group col-md-4')));
        echo $this->Form->input('cel', array('label' => 'Celular', 'class' => 'form-control', 'required', 'div' => array('class' => 'form-group col-md-4')));

        echo $this->Form->input('escolaridade_id', array('label' => 'Escolaridade' ,'class' => 'form-control', 'required', 'div' => array('class' => 'form-group col-md-4'), 'options' => $escolaridades)); 
        echo $this->Form->input('tipo', array('type' => 'hidden', 'value' => '0'));
    ?> 
    <div id="parente" class="row">
        <?php
            $i = 0;
            foreach ($this->request->data['Relacionamento'] as $relacionamento) { ?>
                <div id="<?php echo $i ?>" class="col-md-12">
                <?php 
                    echo $this->Form->input('Relacionamento.'.$i.'.id', array('type' => 'hidden', 'value' => $relacionamento['id']));
                    echo $this->Form->input('Relacionamento.'.$i.'.membro2_id', array('label' => 'Parente', 'class' => 'form-control', 'placeholder' => 'Nome Parente', 'required', 'div' => array('class' => 'form-group col-md-8'), 'options' => $parentes, 'default' => $relacionamento['membro2_id']));
                    echo $this->Form->input('Relacionamento.'.$i.'.tiporelacionamento_id', array('label' => 'Tipo:', 'class' => 'form-control', 'required', 'div' => array('class' => 'form-group col-md-3'), 'options' => $relacionamentos, 'default' => $relacionamento['tiporelacionamento_id'])); ?>
                    <div class="form-group col-md-1">
                        <a href="javascript:;" class="form-control btn btn-danger disabled" onclick="apagaRelacionamento('Relacionamento<?php echo $i; ?>Id', '<?php echo $i; ?>');" data-toggle="tooltip" data-placement="top" title="Remover Parente" style="margin-top:22px;" role="button"><i class="fa fa-trash-o"></i></a>
                    </div>
                    <?php
                    $i++; 
                ?>
                </div>
        <?php } ?>
    </div>
      
        <div class="form-group col-md-12">
            <a href="javascript:;" onclick="addParente()" class="btn btn-primary form-control disabled"><i class="fa fa-plus" role="button"></i> Adicionar Parente</a>
        </div>
      
        <?php
            echo $this->Form->input('profissao_id', array('label' => 'Profissão', 'id' => 'autocomplete', 'class' => 'form-control', 'required', 'options' => $profissoes, 'div' => array('class' => 'form-group col-md-5')));
        ?>
        <div class="form-group col-md-1">
            <a href="javascript:;" class="form-control btn btn-primary disabled" onclick="modalLoadAdd('<?php echo $this->Html->url(array("plugin" => "secretaria", "controller" => "profissaos", "action" => "add")); ?>', 'autocomplete', 'autocomplete');" data-toggle="tooltip" data-placement="top" title="Adicionar Profissão" style="margin-top:22px;" role="button"><i class="fa fa-plus"></i></a>
        </div>
        <?php
            echo $this->Form->input('empresa', array('label' => 'Empresa', 'class' => 'form-control', 'required', 'div' => array('class' => 'form-group col-md-6')));

            echo $this->Form->input('databatismo', array('type' => 'text', 'label' => 'Data de Batismo', 'class' => 'form-control datepicker', 'required', 'div' => array('class' => 'form-group col-md-2')));
            echo $this->Form->input('igrejabatismo', array('label' => 'Igreja Batismo', 'class' => 'form-control', 'placeholder' => 'Nome da igreja que foi batizado', 'required', 'div' => array('class' => 'form-group col-md-5')));
            echo $this->Form->input('pastorbatismo', array('label' => 'Pastor que Batizou', 'class' => 'form-control', 'placeholder' => 'Nome do Pastor que batizou', 'required', 'div' => array('class' => 'form-group col-md-5')));

            echo $this->Form->input('ultimaigreja', array('label' => 'Ultima Igreja que frequentou', 'class' => 'form-control', 'placeholder' => 'Nome da Igreja que Frequentou', 'required', 'div' => array('class' => 'form-group', 'style' => 'padding-right: 15px; padding-left: 15px;')));
            
            if (!empty($this->request->data['Movimentacaoata'])) {
                $i = 0;
                echo '<p>Cargos:</p>';
                foreach ($this->request->data['Movimentacaoata'] as $movimentacaoata) {
                    echo $this->Form->input('cargo'.$i, array('label' => false,'value' => $cargos[$movimentacaoata['cargo_id']], 'class' => 'form-control', 'readonly', 'div' => array('class' => 'form-group col-md-12')));    
                }
            }            

            echo $this->Form->input('igrejasanteriores', array('label' => 'Igrejas que já frequentou', 'class' => 'form-control', 'placeholder' => 'Nome das igrejas que já frequentou (pulando linhas)', 'required', 'div' => array('class' => 'form-group col-md-12')));
        ?>
      <div class="modal fade over-hidden" id="confirmar" tabindex="-1" data-keyboard="false" data-backdrop="static" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content shadowModal">
                <div class="modal-header">
                    <h4 class="modal-title"><i class="fa fa-exclamation-triangle"></i> Confirme as alterações dos dados</h4>
                </div>
                <div class="modal-body">
                    Tem certeza de que quer salvar as alterações nesse cadastro?
                </div>
                <div class="modal-footer">
                    <button class="btn btn-default nao-salvar" type="button">Não quero mais salvar</button>
                    <input class="btn btn-warning" type="submit" value="Sim, quero salvar">
                </div>
            </div>
        </div>
    </div>
    <div class="form-group col-md-2">
        <button data-dismiss="modal" class="btn btn-default form-control" type="button">Fechar</button> 
    </div>
    <div class="form-group col-md-4">
        <a class="btn btn-warning habilita_campos form-control" id="futuro-salvar">Habilitar Edição</a>
        <a class="btn btn-primary form-control" id="salvar-dados" data-toggle="modal" href="#confirmar" style="display:none">Salvar alterações</a>
    </div>
    <?php 
        echo $this->Form->end();
    ?>
<!-- /form -->
</div>


<div class="modal fade over-hidden" id="add_item" tabindex="-1" data-keyboard="false" data-backdrop="static" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content shadowModal">
            <div class="modal-header">
                <h4 class="modal-title"><i class="fa fa-exclamation-triangle"></i> Adicionar</h4>
            </div>
            <div class="modal-body">
                
            </div>
            <div class="modal-footer">
            </div>
        </div>
    </div>
</div>