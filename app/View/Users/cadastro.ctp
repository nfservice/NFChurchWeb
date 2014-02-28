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
                        <form class="form-horizontal">
                            <div class="form-group">
                                <label class="col-lg-2 control-label">Nome Completo</label>
                                <div class="col-lg-8">
                                    <input type="text" class="form-control" placeholder="Nome Completo">
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-lg-2 control-label">Seu Email</label>
                                <div class="col-lg-8">
                                    <input type="email" class="form-control" placeholder="Digite seu Email">
                                </div>
                            </div>

                            <div class="form-group">
                                <label class="col-lg-2 control-label">Sua Senha</label>
                                <div class="col-lg-8">
                                    <input type="password" class="form-control" placeholder="Digite sua senha">
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-lg-2 control-label">RE Sua Senha</label>
                                <div class="col-lg-8">
                                    <input type="email" class="form-control" placeholder="Digite sua senha novamente">
                                </div>
                            </div>

                            <div class="form-group">
                                <label class="col-lg-2 control-label">Sexo</label>
                                <div class="col-lg-4">
                                    Sou do sexo masculino<input type="radio" name="sexo"> 
                                </div>
                                <div class="col-lg-4">
                                    Sou do sexo feminino<input type="radio" name="sexo">
                                </div>
                            </div>

                        </form>
                    </section>

                    <h2>Informações para contato</h2>
                    <section>
                        <form class="form-horizontal">
                             <div class="form-group">
                                <label class="col-lg-2 control-label">Telefone</label>
                                <div class="col-lg-8">
                                    <input type="text" class="form-control" placeholder="Telefone">
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-lg-2 control-label">Celular</label>
                                <div class="col-lg-8">
                                    <input type="text" class="form-control" placeholder="Celular">
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-lg-2 control-label">Endereço</label>
                                <div class="col-lg-8">
                                    <textarea class="form-control" name="endereco" placeholder="Endereço"></textarea> 
                                </div>
                            </div>
                        </form>
                    </section>

                    <h2>Confirmação de Cadastro</h2>
                    <section>
                        <div class="col-lg-12">
                            <p>Anim pariatur cliche reprehenderit, enim eiusmod high life accusamus terry richardson ad squid. 3 wolf moon officia aute, non cupidatat skateboard dolor brunch. Food truck quinoa nesciunt laborum eiusmod. Brunch 3 wolf moon tempor, sunt aliqua put a bird on it squid single-origin coffee nulla assumenda shoreditch et. Nihil anim keffiyeh helvetica, craft beer labore wes anderson cred nesciunt sapiente ea proident. Ad vegan excepteur butcher vice lomo. Leggings occaecat craft beer farm-to-table, raw denim aesthetic synth nesciunt you probably haven't heard of them accusamus labore sustainable VHS.</p>

                            <p>Anim pariatur cliche reprehenderit, enim eiusmod high life accusamus terry richardson ad squid. 3 wolf moon officia aute, non cupidatat skateboard dolor brunch. Food truck quinoa nesciunt laborum eiusmod. Brunch 3 wolf moon tempor, sunt aliqua put a bird on it squid single-origin coffee nulla assumenda shoreditch et.</p>
                            <div class="form-group">
                                <label> 
                                    <input type="checkbox"> Eu aceito todas as condições
                                </label>
                            </div>

                        </div>
                    </section>

                    <h2>Passo Final</h2>
                    <section>
                        <p class="center">Parabéns, você já pode começar a usar o NFBILLING!</p>
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