<?php echo $this->Html->css('assets/jquery-steps-master/demo/css/jquery.steps.css'); ?>
<?php echo $this->Html->script('../css/assets/jquery-steps-master/build/jquery.steps.js'); ?>

<?php 

    echo $this->Form->create(array('User', 'role' => 'form', 'class' => 'desable-form formModal'));
    
    // cadeado para desbloquear o form
    echo $this->element('desbloquearForm');

    echo $this->Form->input('nome', array('type' => 'text', 'label' => 'Nome Completo:', 'class' => 'form-control', 'placeholder' => 'Nome Completo', 'div' => array('class' => 'form-group col-md-6'), 'required'));
    echo $this->Form->input('id', array('type' => 'hidden'));
    echo $this->Form->input('username', array('type' => 'text', 'label' => 'Seu E-mail:', 'class' => 'form-control', 'placeholder' => 'Digite seu E-mail', 'div' => array('class' => 'form-group col-md-6'), 'required')); 
    echo $this->Form->input('password', array('type' => 'password', 'class' => 'form-control', 'label' => 'Sua Senha:', 'placeholder' => 'Digite sua senha:', 'div' => array('class' => 'form-group col-md-3')));
    echo $this->Form->input('repassword', array('type' => 'password', 'label' => 'Repita Sua Senha:', 'class' => 'form-control', 'placeholder' => 'Digite sua senha novamente', 'div' => array('class' => 'form-group col-md-3'))); 
    echo $this->Form->input('telefone', array('type' => 'text', 'class' => 'form-control', 'label' => 'Telefone', 'placeholder' => 'Telefone', 'div' => array('class' => 'form-group col-md-6'), 'required'));
    echo $this->Form->input('celular', array('type' => 'text', 'label' => 'Celular', 'class' => 'form-control', 'placeholder' => 'Celular', 'div' => array('class' => 'form-group col-md-4'), 'required'));
    echo $this->Form->input('cpf', array('type' => 'text', 'class' => 'form-control', 'label' => 'CPF:', 'placeholder' => 'CPF', 'div' => array('class' => 'form-group col-md-8'), 'required')); ?>

    <?php // echo $this->Form->input('Salvar Visitante', array('type' => 'submit', 'label' => false, 'class' => 'btn btn-success form-control', 'div' => array('class' => 'form-group col-md-2'))); ?>
    <div class="col-lg-11"> 
        <section class="panel">
            <header class="panel-heading tab-bg-dark-navy-blue ">
                <ul class="nav nav-tabs">
                    <?php
                        ksort($permissao);
                        $cont = 0;
                        foreach ($permissao as $key => $value) {
                            if ($cont == 0) {
                                $li = '<li class="active">';
                            } else {
                                $li = '<li>';
                            }
                            if ($key != ''){
                                if (!empty($pluginT[$key])) {
                                    $plugin = $pluginT[$key];
                                } else {
                                    $plugin = ucfirst($key);
                                }
                                
                                echo $li.'<a data-toggle="tab" href="#'.$key.'">'.$plugin.'</a></li>';
                            } else{
                                echo $li.'<a data-toggle="tab" href="#Geral">Geral</a></li>';
                            }
                            $cont++;
                        }
                    ?>
                </ul>
            </header>
            <div class="panel-body">
                <div class="tab-content">
                    <?php
                        $hiddens = array(
                            'fblogin',
                            'logout',
                            'login',
                            'searchItem',
                            'autoComplete',
                            'load_events',
                        );
                        ksort($permissao);
                        $cont = 0;
                        foreach ($permissao as $key => $value) {
                            if ($cont == 0) {
                                $class = 'class="tab-pane active"';
                            } else {
                                $class = 'class="tab-pane"';
                            }
                            if ($key == '') {
                                $key = 'Geral';
                            }
                            echo '<div id="'.$key.'" '.$class.'>';
                            echo '<br/>'.$this->Form->input('todos-'.$key, array('type' => 'checkbox','label' => 'Marcar todos', 'onClick' => 'MarcarTodos("'.$key.'", this.checked);'));
                            $controllerAllow = array(
                                'TipoBem',
                                'Departamento',
                                'Autores',
                                'Categorias',
                                'Editoras',
                                'Tipos',
                                'Tiporelacionamentos',
                                'Pages'

                            );
                            foreach ($value as $controller => $chave) {
                                if (!in_array($controller, $controllerAllow)) {
                                
                                    if (!empty($controllerT[$controller])) {
                                        $nome = $controllerT[$controller];
                                    } else {
                                        $nome = ucfirst($controller);
                                    }
                                    echo '<div style="width: 100%;" class="col-lg-2">';
                                    echo '<h3>'.$nome.'</h3>';
                                    echo '</br>';
                                    foreach ($chave as $action) {
                                        if ($key == 'Geral') {
                                            $key = '';
                                        }
                                        if (!in_array($action, $hiddens)) {
                                            echo $this->Form->input('Permission.'.$cont.'.plugin', array('value' => $key,'type' => 'hidden'));
                                            echo $this->Form->input('Permission.'.$cont.'.controller', array('value' => $controller,'type' => 'hidden'));
                                            echo $this->Form->input('Permission.'.$cont.'.action', array('value' => $action, 'type' => 'hidden', 'label' => $action));
                                        
                                            $checked = '';
                                            if (!empty($permissoes[$key.'_'.$controller.'_'.$action]) && $permissoes[$key.'_'.$controller.'_'.$action] == '1') {
                                                $checked = 'checked';
                                            }
                                            if (!empty($actionT[$action])) {
                                                $action = $actionT[$action];
                                            } else {
                                                $action = ucfirst($action);
                                            } 
                                            echo $this->Form->input('Permission.'.$cont.'.allowed', array('value' =>  '1', 'label' => $action, 'type' => 'checkbox', 'checked' => $checked));
                                        } else {
                                            echo $this->Form->input('Permission.'.$cont.'.allowed', array('type' => 'hidden', 'div' => false));
                                        }
                                        $cont++;
                                    }
                                    echo '</div>';
                                }
                            }
                            echo '</div>';
                        }
                    ?>
                </div>
            </div>
        </section>
    </div>
    <?php

        // modal com confirmação de alteração de cadastro
        echo $this->element('modal/controleForm');

        // botoões do formulário
        echo $this->element('botoesForm');

        echo $this->Form->end(); 
    ?>