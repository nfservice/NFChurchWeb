<?php echo $this->Html->css('assets/jquery-steps-master/demo/css/jquery.steps.css'); ?>
<?php echo $this->Html->script('../css/assets/jquery-steps-master/build/jquery.steps.js'); ?>

<?php 

    echo $this->Form->create(array('User', 'role' => 'form', 'class' => 'desable-form formModal'));
    echo $this->Form->input('nome', array('type' => 'text', 'label' => 'Nome Completo:', 'class' => 'form-control', 'placeholder' => 'Nome Completo', 'div' => array('class' => 'form-group col-md-6'), 'required'));
    echo $this->Form->input('username', array('type' => 'text', 'label' => 'Seu E-mail:', 'class' => 'form-control', 'placeholder' => 'Digite seu E-mail', 'div' => array('class' => 'form-group col-md-6'), 'required')); 
    echo $this->Form->input('password', array('type' => 'password', 'class' => 'form-control', 'label' => 'Sua Senha:', 'placeholder' => 'Digite sua senha:', 'div' => array('class' => 'form-group col-md-3')));
    echo $this->Form->input('repassword', array('type' => 'password', 'label' => 'Repita Sua Senha:', 'class' => 'form-control', 'placeholder' => 'Digite sua senha novamente', 'div' => array('class' => 'form-group col-md-3'))); 
    echo $this->Form->input('telefone', array('type' => 'text', 'class' => 'form-control', 'label' => 'Telefone', 'placeholder' => 'Telefone', 'div' => array('class' => 'form-group col-md-6'), 'required'));
    echo $this->Form->input('celular', array('type' => 'text', 'label' => 'Celular', 'class' => 'form-control', 'placeholder' => 'Celular', 'div' => array('class' => 'form-group col-md-4'), 'required'));
    echo $this->Form->input('cpf', array('type' => 'text', 'class' => 'form-control', 'label' => 'CPF:', 'placeholder' => 'CPF', 'div' => array('class' => 'form-group col-md-8'), 'required')); ?>

    <?php // echo $this->Form->input('Salvar Visitante', array('type' => 'submit', 'label' => false, 'class' => 'btn btn-success form-control', 'div' => array('class' => 'form-group col-md-2'))); ?>
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
    <div class="form-group col-md-4">
        <button data-dismiss="modal" class="btn btn-default" type="button">Cancelar</button>    
        <a class="btn btn-warning habilita_campos" id="futuro-salvar">Habilitar Edição</a>
        <a class="btn btn-primary" id="salvar-dados" data-toggle="modal" href="#confirmar" style="display:none">Salvar alterações</a>
    </div>
    <?php 
    echo $this->Form->end(); ?>