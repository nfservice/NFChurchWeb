<?php
    $fromOptions = ['role' => 'form', 'class' => 'formModal'];
    if (strpos($this->request->params['action'], 'edit') !== false) {
        $fromOptions['class'] = 'desable-form formModal';
    }
?>
<?php
    echo $this->Form->input('Relacionamento.X.membro2_id', array('label' => 'Parente', 'empty' => 'Selecione', 'class' => 'form-control', 'placeholder' => 'Nome Parente', 'div' => array('class' => 'form-group col-md-6'), 'type' => 'text'));
    echo $this->Form->input('Relacionamento.X.tiporelacionamento_id', array('label' => 'Tipo:', 'placeholder' => 'Relacionamento', 'class' => 'form-control', 'div' => array('class' => 'form-group col-md-3'), 'type' => 'text'));
    echo $this->Form->input('MembroCargo.X.cargo_id', array('label' => 'Cargo:', 'placeholder' => 'Cargo', 'class' => 'form-control', 'div' => array('class' => 'form-group col-md-10'), 'type' => 'text'));
?>
<?php echo $this->Form->create('Membro', $fromOptions); ?>
    <?php if (strpos($this->request->params['action'], 'edit') !== false) { ?>
        <div class="col-md-12">
            <div class="alert alert-warning" id="msg_block">    
                <p><button type="button" class="btn btn-success habilita_campos" id="futuro-salvar"><i class="fa fa-unlock"></i></button> Clique no cadeado ao lado para desbloquear os campos do formulário</p>
            </div>
        </div>
    <?php } ?>
    <?php
      
        echo $this->Form->unput('id', array('type' => 'hidden'));

        $options = array('1' => 'Sim', '0' => 'Não');
        echo $this->Form->input('ativo', array('label' => 'Ativo:' ,'class' => 'form-control combobox', 'options' => $options, 'div' => array('class' => 'form-group col-md-3'))); 
        
        echo $this->Form->input('datamembro', array('type' => 'text', 'label' => 'Tornou-se Membro em:' ,'class' => 'form-control datepicker', 'div' => array('class' => 'form-group col-md-3'), 'data-date-format' => 'dd/mm/yyyy')); 
        echo $this->Form->input('nome', array('label' => 'Nome do Membro' ,'placeholder' => 'Nome do Membro', 'class' => 'form-control', 'div' => array('class' => 'form-group col-md-6')));

        echo $this->Form->input('email', array('label' => 'Email Pessoal' ,'placeholder' => 'Entre com seu email', 'class' => 'form-control', 'div' => array('class' => 'form-group col-md-6')));
    ?>
    <div class="row" id="MembroCargo">
        <?php if (!empty($this->request->data['Cargo'])) {
            foreach ($this->request->data['MembroCargo'] as $key => $value) { ?>
                <div class="col-md-12" id="cargo-<?php echo $key ?>">
                    <?php $carg = !empty($value['cargo_id']) ? $value['cargo_id'] : null; ?>
                    <?php
                        echo $this->Form->input('MembroCargo.'.$key.'.id', array('class' => 'form-control', 'type' => 'hidden'));
                        echo $this->Form->input('MembroCargo.'.$key.'.cargo_id', array('label' => 'Cargo', 'class' => 'form-control', 'div' => array('class' => 'form-group col-md-10'), 'type' => 'text', 'value' => !empty($cargos[$carg]) ? $carg.', '.$cargos[$carg] : ''));
                    ?>
                    <div class="form-group col-md-1">
                        <a href="javascript:;" class="form-control btn btn-primary btns" onclick="modalLoadAdd('<?php echo $this->Html->url(array("plugin" => "secretaria", "controller" => "cargos", "action" => "add")); ?>', 'autocomplete', 'autocomplete');" data-toggle="tooltip" data-placement="top" title="Adicionar Cargo" style="margin-top:22px;" role="button">
                            <i class="fa fa-plus"></i>
                        </a>
                    </div>
                    <div class="form-group col-md-1">
                        <a href="javascript:;" class="form-control btn btn-danger btns" onclick="apagaMembroCargo('MembroCargo<?php echo $key ?>Id', '<?php echo $key ?>', '<?php echo $this->Html->url(array('plugin' => 'secretaria', 'controller' => 'membros', 'action' => 'removeMembroCargo')); ?>');" data-toggle="tooltip" data-placement="top" title="Remover Cargo do membro" style="margin-top:22px;" role="button"><i class="fa fa-trash-o"></i></a>
                    </div>
                </div>
            <?php } ?>
        <?php } else { ?>
            <div class="col-md-12" id="cargo-0">
                <?php
                    echo $this->Form->input('MembroCargo.0.cargo_id', array('label' => 'Cargo', 'class' => 'form-control', 'div' => array('class' => 'form-group col-md-10'), 'type' => 'text'));
                ?>
                <div class="form-group col-md-1">
                    <a href="javascript:;" class="form-control btn btn-primary btns" onclick="modalLoadAdd('<?php echo $this->Html->url(array("plugin" => "secretaria", "controller" => "cargos", "action" => "add")); ?>', 'autocomplete', 'autocomplete');" data-toggle="tooltip" data-placement="top" title="Adicionar Cargo" style="margin-top:22px;" role="button">
                        <i class="fa fa-plus"></i>
                    </a>
                </div>
                <div class="form-group col-md-1">
                    <a href="javascript:;" class="form-control btn btn-danger btns" onclick="apagaMembroCargo('MembroCargo0Id', '0', '<?php echo $this->Html->url(array('plugin' => 'secretaria', 'controller' => 'membros', 'action' => 'removeMembroCargo')); ?>');" data-toggle="tooltip" data-placement="top" title="Remover Cargo do membro" style="margin-top:22px;" role="button"><i class="fa fa-trash-o"></i></a>
                </div>
            </div>
        <?php } ?>
    </div>
    <div class="form-group col-md-12">
        <a href="javascript:;" class="form-control btn btn-primary btns" onclick="addMembroCargo();" data-toggle="tooltip" data-placement="top" title="Adicionar Cargo para o membro" style="margin-top:22px;" role="button">
            <i class="fa fa-plus"></i>Adicionar Cargo para o Membro
        </a>
    </div>
    <?php
        echo $this->Form->input('sexo', array('label' => 'Sexo' ,'class' => 'form-control', 'div' => array('class' => 'form-group col-md-3'), 'options' => array('0' => 'Selecione', '1' => 'Masculino', '2' => 'Feminino')));
    ?>
    <div class="nascimento">
        <?php 
            echo $this->Form->input('datanascimento', array('type' => 'text', 'label' => 'Data de Nascimento' ,'class' => 'form-control datepicker', 'div' => array('class' => 'form-group col-md-4'), 'data-date-format' => 'dd/mm/yyyy'));
            echo $this->Form->input('naturalidade', array('label' => 'Naturalidade' ,'placeholder' => 'Ex: Brasileiro', 'class' => 'form-control', 'div' => array('class' => 'form-group col-md-4')));
        ?>
    </div>
    <?php
        echo $this->Form->input('estadocivil', array('label' => 'Estado Civil' ,'class' => 'form-control select2', 'div' => array('class' => 'form-group col-md-4'), 'options' => array('0' => 'Solteiro(a)', '1' => 'Casado(a)', '2' => 'Viuvo(a)', '3' => 'Divorciado(a)', '4' => 'Separado(a)', '5' => 'Companheiro(a)')));
        echo $this->Form->input('rg', array('label' => 'RG' ,'placeholder' => '00.000.000-0', 'class' => 'form-control', 'div' => array('class' => 'form-group col-md-4')));
        echo $this->Form->input('cpf', array('label' => 'CPF' ,'placeholder' => '000.000.000-00', 'class' => 'form-control', 'div' => array('class' => 'form-group col-md-4')));

        echo $this->Form->input('fone', array('label' => 'Telefone', 'class' => 'form-control', 'div' => array('class' => 'form-group col-md-4')));
        echo $this->Form->input('cel', array('label' => 'Celular', 'class' => 'form-control', 'div' => array('class' => 'form-group col-md-4')));


        $esc = !empty($this->request->data['Membro']['escolaridade_id']) ? $this->request->data['Membro']['escolaridade_id'] : null;
        echo $this->Form->input('escolaridade_id', array('label' => 'Escolaridade' ,'class' => 'form-control', 'div' => array('class' => 'form-group col-md-7'), 'type' => 'text', 'value' => !empty($escolaridades[$esc]) ? $esc.', '.$escolaridades[$esc] : ''));
    ?>
        <div class="form-group col-md-1">
            <a href="javascript:;" class="form-control btn btn-primary btns" onclick="modalLoadAdd('<?php echo $this->Html->url(array("plugin" => "secretaria", "controller" => "escolaridades", "action" => "add")); ?>', 'autocomplete', 'autocomplete');" data-toggle="tooltip" data-placement="top" title="Adicionar Escolaridade" style="margin-top:22px;" role="button">
                <i class="fa fa-plus"></i>
            </a>
        </div>
    <?php
        echo $this->Form->input('tipo', array('type' => 'hidden', 'value' => '0'));
        echo $this->Form->input('Endereco.cep', array('type' => 'text', 'label' => 'Cep:', 'class' => 'form-control', 'div' => array('class' => 'form-group col-md-2')));
        echo $this->Form->input('Endereco.logradouro', array('type' => 'text', 'label' => 'Logradouro', 'class' => 'form-control', 'div' => array('class' => 'form-group col-md-6')));
        echo $this->Form->input('Endereco.numero', array('type' => 'text', 'label' => 'Número', 'class' => 'form-control', 'div' => array('class' => 'form-group col-md-1')));
        echo $this->Form->input('Endereco.bairro', array('type' => 'text', 'label' => 'Bairro', 'class' => 'form-control', 'div' => array('class' => 'form-group col-md-3')));
        echo $this->Form->input('Endereco.complemento', array('type' => 'text', 'label' => 'Complemento:', 'class' => 'form-control', 'div' => array('class' => 'form-group col-md-2')));
        echo $this->Form->input('Endereco.cidade', array('type' => 'text', 'label' => 'Cidade', 'class' => 'form-control', 'div' => array('class' => 'form-group col-md-6')));
        echo $this->Form->input('Endereco.estado_id', array('label' => 'Estado', 'options' => $estados, 'class' => 'form-control select2', 'div' => array('class' => 'form-group col-md-4')));
    ?> 
    <div id="parente" class="row">
        <?php
            if (!empty($this->request->data['Relacionamento'])) {
                $i = 0;
                foreach ($this->request->data['Relacionamento'] as $relacionamento) { ?>
                    <?php if (!empty($relacionamento['Membro'])){ ?>
                        <div id="<?php echo $i ?>" class="col-md-12">
                            <?php 
                                echo $this->Form->input('Relacionamento.'.$i.'.id', array('type' => 'hidden', 'value' => $relacionamento['id']));
                                echo $this->Form->input('Relacionamento.'.$i.'.membro2_id', array('label' => 'Parente', 'empty' => 'Selecione', 'class' => 'membro form-control', 'placeholder' => 'Nome Parente', 'div' => array('class' => 'form-group col-md-6'), 'type' => 'text', 'value' => $relacionamento['membro2_id'].','.$relacionamento['Membro']['nome']));
                                
                                ?>
                                <div class="form-group col-md-1">
                                    <a href="javascript:;" class="form-control btn btn-primary btns" onclick="modalLoadAdd('<?php echo $this->Html->url(array("plugin" => "secretaria", "controller" => "visitantes", "action" => "add")); ?>', 'autocomplete', 'autocomplete');" data-toggle="tooltip" data-placement="top" title="Adicionar Parente" style="margin-top:22px;" role="button"><i class="fa fa-plus"></i></a>
                                </div>
                                <?php echo $this->Form->input('Relacionamento.'.$i.'.tiporelacionamento_id', array('label' => 'Tipo:', 'placeholder' => 'Relacionamento', 'class' => 'tiporelacionamento form-control', 'div' => array('class' => 'form-group col-md-3'), 'type' => 'text', 'value' => $relacionamento['tiporelacionamento_id'].','.$relacionamentos[$relacionamento['tiporelacionamento_id']])); ?>
                                <div class="form-group col-md-1">
                                    <a href="javascript:;" class="form-control btn btn-primary btns" onclick="modalLoadAdd('<?php echo $this->Html->url(array("plugin" => "secretaria", "controller" => "tiporelacionamentos", "action" => "add")); ?>', 'Relacionamento<?php echo $i ?>TiporelacionamentoId', 'Relacionamento<?php echo $i ?>TiporelacionamentoId');" data-toggle="tooltip" data-placement="top" title="Adicionar Tipo de Relacionamento" style="margin-top:22px;" role="button"><i class="fa fa-plus"></i></a>
                                </div>
                                <div class="form-group col-md-1">
                                    <a href="javascript:;" class="form-control btn btn-danger btns" onclick="apagaRelacionamento('Relacionamento<?php echo $i; ?>Id', '<?php echo $i; ?>', '<?php echo $this->Html->url(array('plugin' => 'secretaria', 'controller' => 'membros', 'action' => 'desvincular')); ?>');" data-toggle="tooltip" data-placement="top" title="Remover Parente" style="margin-top:22px;" role="button"><i class="fa fa-trash-o"></i></a>
                                </div>
                                <?php $i++; ?>
                            </div>
                    <?php } ?>
            <?php }
            } else {
                echo '<div id="0" class="col-md-12">';
                    echo $this->Form->input('Relacionamento.0.membro_id', array('type' => 'hidden'));
                    echo $this->Form->input('Relacionamento.0.membro2_id', array('label' => 'Parente', 'empty' => 'Selecione', 'class' => 'membro form-control', 'placeholder' => 'Nome Parente', 'div' => array('class' => 'form-group col-md-6'), 'type' => 'text'));
                    ?>
                    <div class="col-md-1 form-group">
                        <a href="javascript:;" class="form-control btn btn-primary" onclick="modalLoadAdd('<?php echo $this->Html->url(array("plugin" => "secretaria", "controller" => "visitantes", "action" => "add")); ?>', 'Relacionamento0Membro2Id', 'Relacionamento0Membro2Id');" data-toggle="tooltip" data-placement="top" title="Adicionar Parente" style="margin-top:22px;" role="button">
                            <i class="fa fa-plus"></i>
                        </a>
                    </div>
                    <?php
                        echo $this->Form->input('Relacionamento.0.tiporelacionamento_id', array('label' => 'Tipo:', 'placeholder' => 'Relacionamento', 'class' => 'tiporelacionamento form-control', 'div' => array('class' => 'form-group col-md-3'), 'type' => 'text'));
                    ?>
                    <div class="form-group col-md-1">
                        <a href="javascript:;" class="form-control btn btn-primary btns" onclick="modalLoadAdd('<?php echo $this->Html->url(array("plugin" => "secretaria", "controller" => "tiporelacionamentos", "action" => "add")); ?>', 'Relacionamento0TiporelacionamentoId', 'Relacionamento0TiporelacionamentoId');" data-toggle="tooltip" data-placement="top" title="Adicionar Tipo de Relacionamento" style="margin-top:22px;" role="button"><i class="fa fa-plus"></i></a>
                    </div>
                    <div class="form-group col-md-1">
                        <a href="javascript:;" class="form-control btn btn-danger btns" onclick="apagaRelacionamento('Relacionamento0Id', '0', '<?php echo $this->Html->url(array('plugin' => 'secretaria', 'controller' => 'membros', 'action' => 'desvincular')); ?>');" data-toggle="tooltip" data-placement="top" title="Remover Parente" style="margin-top:22px;" role="button"><i class="fa fa-trash-o"></i></a>
                    </div>
                </div>
            <?php } ?>
            
    </div>
      
        <div class="form-group col-md-12">
            <a href="javascript:;" onclick="addParente(addToolTip)" class="btn btn-primary form-control btns"><i class="fa fa-plus" role="button"></i> Adicionar Parente</a>
        </div>
      
        <?php
            echo $this->Form->input('profissao_id', array('label' => 'Profissão', 'empty' => 'Selecione', 'id' => 'autocomplete', 'class' => 'form-control select2', 'options' => $profissoes, 'div' => array('class' => 'form-group col-md-5')));
        ?>
        <div class="form-group col-md-1">
            <a href="javascript:;" class="form-control btn btn-primary btns" onclick="modalLoadAdd('<?php echo $this->Html->url(array("plugin" => "secretaria", "controller" => "profissaos", "action" => "add")); ?>', 'autocomplete', 'autocomplete');" data-toggle="tooltip" data-placement="top" title="Adicionar Profissão" style="margin-top:22px;" role="button"><i class="fa fa-plus"></i></a>
        </div>
        <?php
            echo $this->Form->input('empresa', array('label' => 'Empresa', 'class' => 'form-control', 'div' => array('class' => 'form-group col-md-6')));

            echo $this->Form->input('databatismo', array('type' => 'text', 'label' => 'Data de Batismo', 'class' => 'form-control datepicker', 'div' => array('class' => 'form-group col-md-2')));
            echo $this->Form->input('igrejabatismo', array('label' => 'Igreja Batismo', 'class' => 'form-control', 'placeholder' => 'Nome da igreja que foi batizado', 'div' => array('class' => 'form-group col-md-5')));
            echo $this->Form->input('pastorbatismo', array('label' => 'Pastor que Batizou', 'class' => 'form-control', 'placeholder' => 'Nome do Pastor que batizou', 'div' => array('class' => 'form-group col-md-5')));

            $den = !empty($this->request->data['Membro']['denominacao_id']) ? $this->request->data['Membro']['denominacao_id'] : null;
            echo $this->Form->input('denominacao_id', array('label' => 'Ultima Igreja que frequentou', 'class' => 'form-control', 'placeholder' => 'Nome da Igreja que Frequentou', 'div' => array('class' => 'form-group col-md-11'), 'type' => 'text', 'value' => !empty($denominacaos[$den]) ? $den.', '.$denominacaos[$den] : ''));
            ?>
            <div class="form-group col-md-1">
                <a href="javascript:;" class="form-control btn btn-primary btns" onclick="modalLoadAdd('<?php echo $this->Html->url(array("plugin" => "secretaria", "controller" => "denominacaos", "action" => "add")); ?>', 'autocomplete', 'autocomplete');" data-toggle="tooltip" data-placement="top" title="Adicionar Denominação" style="margin-top:22px;" role="button"><i class="fa fa-plus"></i></a>
            </div>
            <?php
            
            if (!empty($this->request->data['Movimentacaoata'])) {
                $i = 0;
                echo '<p>Cargos:</p>';
                foreach ($this->request->data['Movimentacaoata'] as $movimentacaoata) {
                    echo $this->Form->input('cargo'.$i, array('label' => false,'value' => $cargos[$movimentacaoata['cargo_id']], 'class' => 'form-control', 'readonly', 'div' => array('class' => 'form-group col-md-12')));    
                }
            }            

            echo $this->Form->input('igrejasanteriores', array('label' => 'Igrejas que já frequentou', 'class' => 'form-control', 'placeholder' => 'Nome das igrejas que já frequentou (pulando linhas)', 'div' => array('class' => 'form-group col-md-12')));

            echo $this->Form->input('motivodesligamento', array('label' => 'Motivo de Desligamento', 'class' => 'form-control', 'placeholder' => 'Motivo de desligamento (pulando linhas)', 'div' => array('class' => 'form-group col-md-12')));
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
    <?php

        // modal com confirmação de alteração de cadastro
        echo $this->element('modal/controleForm');

        if (strpos($this->request->params['action'], 'add') !== false) {
            echo $this->Form->input('Cancelar', array('type' => 'button', 'data-dismiss' => 'modal', 'label' => false, 'class' => 'btn btn-default form-control', 'div' => array('class' => 'form-group col-md-2')));
            echo $this->Form->input('Salvar Membro', array('type' => 'submit', 'label' => false, 'class' => 'btn btn-success form-control', 'div' => array('class' => 'form-group col-md-4')));
            
            echo $this->Form->end();
        } else {
            // botoões do formulário
            echo $this->element('botoesForm');
        }
    ?>
<?php echo $this->Form->end(); ?>
<?php echo $this->Html->script(['membros']) ?>
<script type="text/javascript">
    var action = '<?php echo $this->request->params['action'] ?>';
    var cont = '<?php echo !empty($this->request->data['Relacionamento']) ? count($this->request->data['Relacionamento']) : 0 ?>';
    var contCargo = '<?php echo !empty($this->request->data['MembroCargo']) ? count($this->request->data['MembroCargo']) : 0 ?>';

    function addParente(callback){
        cont++;
        membro = $('#RelacionamentoXMembro2Id').parent().clone().html();
        membro = membro.replaceAll('RelacionamentoXMembro2Id','Relacionamento'+cont+'Membro2Id').replaceAll('data[Relacionamento][X][membro2_id]','data[Relacionamento]['+cont+'][membro2_id]');
        relacionamento = $('#RelacionamentoXTiporelacionamentoId').parent().clone().html();
        relacionamento = relacionamento.replaceAll('RelacionamentoXTiporelacionamentoId','Relacionamento'+cont+'TiporelacionamentoId').replaceAll('data[Relacionamento][X][tiporelacionamento_id]','data[Relacionamento]['+ cont+'][tiporelacionamento_id]');
        $('#parente').append('<div id="'+cont+'" class="col-md-12"><input type="hidden" name="data[Relacionamento]['+cont+'][membro_id]" id="Relacionamento'+cont+'PessoaId" value="<?php echo !empty($this->request->data['Membro']['id']) ? $this->request->data['Membro']['id'] : null ?>"><div class="form-group col-md-6">'+membro+'</div><div class="col-md-1 form-group"><a href="javascript:;" class="form-control btn btn-primary" onclick="modalLoadAdd(\'<?php echo $this->Html->url(array("plugin" => "secretaria", "controller" => "visitantes", "action" => "add")); ?>\', \'Relacionamento'+cont+'Membro2Id\', \'Relacionamento0Membro2Id\');" data-toggle="tooltip" data-placement="top" title="Adicionar Parente" style="margin-top:22px;" role="button"><i class="fa fa-plus"></i></a></div><div class="form-group col-md-3">'+relacionamento+'</div><div class="form-group col-md-1"><a href="javascript:;" class="form-control btn btn-primary btns" onclick="modalLoadAdd(\'<?php echo $this->Html->url(array("plugin" => "secretaria", "controller" => "tiporelacionamentos", "action" => "add")); ?>\', \'Relacionamento'+cont+'TiporelacionamentoId\', \'Relacionamento'+cont+'TiporelacionamentoId\');" data-toggle="tooltip" data-placement="top" title="Adicionar Tipo de Relacionamento" style="margin-top:22px;" role="button"><i class="fa fa-plus"></i></a></div><div class="col-md-1" style="margin-top: 22px !important"><a href="javascript:;" onclick="removeParente('+cont+')" class="btn btn-danger form-control"><i class="fa fa-trash-o"></i></a></div></div>');

        $('#Relacionamento'+cont+'Membro2Id').addClass('membro').parent().show();
        $('#Relacionamento'+cont+'TiporelacionamentoId').addClass('tiporelacionamento').parent().show();

        addSelect2Ajax();
    }

    function addMembroCargo(callback){
        contCargo++;
        membrocargo = $('#MembroCargoXCargoId').parent().clone().html();
        membrocargo = membrocargo.replaceAll('MembroCargoXCargoId','MembroCargo'+contCargo+'CargoId').replaceAll('data[MembroCargo][X][cargo_id]','data[MembroCargo]['+ contCargo+'][cargo_id]');
        $('#MembroCargo').append('<div id="cargo-'+contCargo+'" class="col-md-12"><input type="hidden" name="data[MembroCargo]['+contCargo+'][id]" id="MembroCargo'+contCargo+'Id"><div class="form-group col-md-10">'+membrocargo+'</div><div class="form-group col-md-1"><a href="javascript:;" class="form-control btn btn-primary btns" onclick="modalLoadAdd(\'<?php echo $this->Html->url(array("plugin" => "secretaria", "controller" => "cargos", "action" => "add")); ?>\', \'MembroCargo'+contCargo+'CargoId\', \'MembroCargo'+contCargo+'CargoId\');" data-toggle="tooltip" data-placement="top" title="Adicionar Cargo" style="margin-top:22px;" role="button"><i class="fa fa-plus"></i></a></div><div class="form-group col-md-1"><a href="javascript:;" class="form-control btn btn-danger btns" onclick="removeParente(\'cargo-'+contCargo+'\');" data-toggle="tooltip" data-placement="top" title="Remover Cargo do membro" style="margin-top:22px;" role="button"><i class="fa fa-trash-o"></i></a></div></div>');
        $('#MembroCargo'+contCargo+'CargoId').addClass('cargo').parent().show();

        $('#MembroCargo'+contCargo+'CargoId').select2({
            placeholder: 'Cargo',
            allowClear: true,
            //minimumInputLength: 1,
            ajax: { // instead of writing the function to execute the request we use Select2's convenient helper
                url: commonurl+"pages/selectAjax/",
                dataType: 'json',
                method: 'GET',
                quietMillis: 250,
                data: function (term) {
                    return {
                        q: term, // search term
                        m: 'Cargo', // Model para consulta
                        f: 'nome' // campo para consulta
                    };
                },
                results: function (data) {
                    return { results: data.items };
                },
                processResults: function (data, page) {
                    // parse the results into the format expected by Select2.
                    // since we are using custom formatting functions we do not need to
                    // alter the remote JSON data
                    return {
                        results: data
                    };
                },
                cache: true
            },
            minimumInputLength: 1,
            formatNoMatches: function(term) {
                /* customize the no matches output */
                return 'Sem resultados.';
            },
            escapeMarkup: function (m) { return m; }, // we do not want to escape markup since we are displaying html in results
            initSelection: function(element, callback) {
                var data = {};
                $(element).each(function () {
                    var value = this.value.split(",");
                    data = {id: value[0], text: value[1]};
                });
                callback(data);
            }
        });
        
        addToolTip();
    }
    $(document).ready(function(){
        $('#RelacionamentoXMembro2Id').parent().hide();
        $('#RelacionamentoXTiporelacionamentoId').parent().hide();
        $('#MembroCargoXCargoId').parent().hide();
        $('.select2').select2();
        addToolTip();
        addSelect2Ajax();
        addSelect2Multi();
        $('#MembroAtivo').on('change', function(){
            $('#MembroMotivodesligamento').parent().hide();
            if (this.value == 0) {
                $('#MembroMotivodesligamento').parent().show();
            }
        }).change();
    });
</script>