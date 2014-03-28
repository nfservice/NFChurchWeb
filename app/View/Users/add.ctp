<?php echo $this->Html->css('assets/jquery-steps-master/demo/css/jquery.steps.css'); ?>
<?php echo $this->Html->script('../css/assets/jquery-steps-master/build/jquery.steps.js'); ?>
<div class="row">
    <div class="col-sm-12">
        <section class="panel">
            <header class="panel-heading">
                Cadastro NFCHURCH
            </header>
            <div class="panel-body">
                <div id="wizard">
                    <h2>Informações Pessoais</h2>

                    <section>
                        <?php echo $this->Form->create('User') ?>
                            <div class="form-group">
                                <div class="col-lg-8">
                                    <?php echo $this->Form->input('nome', array('type' => 'text', 'label' => 'Nome Completo:', 'class' => 'form-control', 'placeholder' => 'Nome Completo')); ?>
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="col-lg-8">
                                    <?php echo $this->Form->input('username', array('type' => 'text', 'label' => 'Seu E-mail:', 'class' => 'form-control', 'placeholder' => 'Digite seu E-mail')); ?>
                                </div>
                            </div>

                            <div class="form-group">
                                <div class="col-lg-8">
                                    <?php echo $this->Form->input('password', array('type' => 'password', 'class' => 'form-control', 'label' => 'Sua Senha:', 'placeholder' => 'Digite sua senha:')) ?>
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="col-lg-8">
                                    <?php echo $this->Form->input('repassword', array('type' => 'password', 'label' => 'Repita Sua Senha:', 'class' => 'form-control', 'placeholder' => 'Digite sua senha novamente')); ?>
                                </div>
                            </div>
                             <div class="form-group">
                                <div class="col-lg-8">
                                    <?php echo $this->Form->input('telefone', array('type' => 'text', 'class' => 'form-control', 'label' => 'Telefone', 'placeholder' => 'Telefone')) ?>
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="col-lg-8">
                                    <?php echo $this->Form->input('celular', array('type' => 'text', 'label' => 'Celular', 'class' => 'form-control', 'placeholder' => 'Celular')); ?>
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="col-lg-8">
                                    <?php echo $this->Form->input('cpf', array('type' => 'text', 'class' => 'form-control', 'label' => 'CPF:', 'placeholder' => 'CPF')); ?>
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="col-lg-8">
                                  <?php echo $this->Form->input('salvar', array('type' => 'submit', 'class' => 'btn btn-success', 'label' => false, 'value' => 'Salvar')); ?>
                                </div>
                            </div>
                        <?php echo $this->Form->end(); ?>
                    </section>
                </div>
            </div>
        </section>
    </div>
</div>

<script>
    $(function () {
        $("#wizard").steps({
            headerTag: "h2",
            bodyTag: "section",
            transitionEffect: "slideLeft"
        });
    });
</script>