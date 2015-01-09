<?php echo $this->Form->create('PermissaoPadrao'); ?>
<div class="col-md-12"> 
    <section class="panel">
        <header class="panel-heading">
            Parametros
        </header>
        <div class="panel-body">
            <div class="col-lg-12"> 
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
                                    'cascade'
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
                                                    echo $this->Form->input('PermissaoPadrao.'.$cont.'.plugin', array('value' => $key,'type' => 'hidden'));
                                                    echo $this->Form->input('PermissaoPadrao.'.$cont.'.controller', array('value' => $controller,'type' => 'hidden'));
                                                    echo $this->Form->input('PermissaoPadrao.'.$cont.'.action', array('value' => $action, 'type' => 'hidden', 'label' => $action));
                                                
                                                    $checked = '';
                                                    if (!empty($permissoes[$key.'_'.$controller.'_'.$action]) && $permissoes[$key.'_'.$controller.'_'.$action] == '1') {
                                                        $checked = 'checked';
                                                    }
                                                    if (!empty($actionT[$action])) {
                                                        $action = $actionT[$action];
                                                    } else {
                                                        $action = ucfirst($action);
                                                    } 
                                                    echo $this->Form->input('PermissaoPadrao.'.$cont.'.allowed', array('value' =>  '1', 'label' => $action, 'type' => 'checkbox', 'checked' => $checked));
                                                } else {
                                                    echo $this->Form->input('PermissaoPadrao.'.$cont.'.allowed', array('type' => 'hidden', 'div' => false));
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
            <div class="form-group col-md-4">
                <input type="submit" class="btn btn-primary form-control" value="Salvar alterações">
            </div>
            <?php
                // modal com confirmação de alteração de cadastro
                echo $this->element('modal/controleForm');

                // botoões do formulário
                echo $this->Form->end();
            ?>
        </div>
    </section>
</div>

