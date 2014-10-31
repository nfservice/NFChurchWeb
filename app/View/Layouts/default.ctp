<!DOCTYPE html>
<html lang="pt-br">
<head> 
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="">
    <meta name="author" content="ThemeBucket">
    <link rel="shortcut icon" href="images/favicon.html">
    <title>NFCHURCH - Gestão de Igrejas</title>
    <!--Core CSS -->
    <?php 
        //array com os cores css
    echo $this->Html->css(array(
        'bootstrap', 
        'assets/jquery-ui/jquery-ui-1.10.1.custom.min', 
        'bootstrap-reset', 
        'assets/font-awesome/css/font-awesome', 
        'assets/jvector-map/jquery-jvectormap-1.2.2', 
        'clndr',
        'assets/morris-chart/morris.css',
        'style',
        'style-responsive.css',
        'select2',
        'multi-select',
        'nfchurch'
        ));

    echo $this->Html->css('assets/css3clock/css/style');
        //Morris Chart CSS
    echo $this->Html->css('assets/morris-chart/morris');

    echo $this->Html->script(array('jquery', 'mask.js', 'bootstrap.min.js'));

    echo $this->Html->css(array(
        'assets/bootstrap-switch-master/build/css/bootstrap3/bootstrap-switch.css',
        'assets/bootstrap-fileupload/bootstrap-fileupload.css',
        'assets/bootstrap-wysihtml5/bootstrap-wysihtml5.css',
        'assets/bootstrap-datepicker/css/datepicker.css',
        'assets/bootstrap-timepicker/compiled/timepicker.css',
        'assets/bootstrap-colorpicker/css/colorpicker.css',
        'assets/bootstrap-daterangepicker/daterangepicker-bs3.css',
        'assets/bootstrap-datetimepicker/css/datetimepicker.css',
        'assets/jquery-multi-select/css/multi-select.css',
        'assets/jquery-tags-input/jquery.tagsinput.css',
        'pace.css',
    ));
    
    ?>
    <link href="//maxcdn.bootstrapcdn.com/font-awesome/4.2.0/css/font-awesome.min.css" rel="stylesheet">
    <!-- Just for debugging purposes. Don't actually copy this line! -->
    <!--[if lt IE 9]><script src="js/ie8/ie8-responsive-file-warning.js"></script><![endif]-->
    <!-- HTML5 shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!--[if lt IE 9]>
    <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
    <script src="https://oss.maxcdn.com/libs/respond.js/1.3.0/respond.min.js"></script>
    <![endif]-->
    <script type="text/javascript">
        //var urlApagaRegChecked = 'eae';
        var urlApagaRegChecked = "<?php echo $this->Html->url(array('plugin' => 'secretaria', 'controller' => 'visitantes', 'action' => 'delete')); ?>";
    </script>

</head>
<body>
    <section id="container">
        <!--header start-->
        <header class="header fixed-top clearfix">
            <!--logo start-->
            <div class="brand">

                <a href="index-2.html" class="logo">
                    <?php echo $this->Html->image('../images/logo.png', array('alt' => 'NFCHURCH - SISTEMA DE GESTÃO PARA EMPRESAS')); ?>
                </a>
                <div class="sidebar-toggle-box">
                    <div class="fa fa-bars"></div>
                </div>
            </div>
            <!--logo end-->

            <div class="nav notify-row" id="top_menu">
                <!--  notification start -->
                <ul class="nav top-menu">
                    <!-- settings start -->
                    
                    <!-- settings end -->
                    <!-- inbox dropdown start-->
                    <li id="header_inbox_bar" class="dropdown">
                        <a data-toggle="dropdown" class="dropdown-toggle" href="#">
                            <i class="fa fa-envelope-o"></i>
                            <span class="badge bg-important">4</span>
                        </a>
                        <ul class="dropdown-menu extended inbox">
                            <li>
                                <p class="red">Você tem 4 Mensagens</p>
                            </li>
                            <li>
                                <a href="#">
                                    <span class="photo"><?php echo $this->Html->image('../images/avatar-mini.jpg'); ?></span>
                                    <span class="subject">
                                        <span class="from">Jonathan Smith</span>
                                        <span class="time">Just now</span>
                                    </span>
                                    <span class="message">
                                        Hello, this is an example msg.
                                    </span>
                                </a>
                            </li>
                            <li>
                                <a href="#">
                                    <span class="photo"><?php echo $this->Html->image('../images/avatar-mini-2.jpg'); ?></span>
                                    <span class="subject">
                                        <span class="from">Jane Doe</span>
                                        <span class="time">2 min ago</span>
                                    </span>
                                    <span class="message">
                                        Nice admin template
                                    </span>
                                </a>
                            </li>
                            <li>
                                <a href="#">
                                    <span class="photo"><?php echo $this->Html->image('../images/avatar-mini-3.jpg'); ?></span>
                                    <span class="subject">
                                        <span class="from">Tasi sam</span>
                                        <span class="time">2 days ago</span>
                                    </span>
                                    <span class="message">
                                        This is an example msg.
                                    </span>
                                </a>
                            </li>
                            <li>
                                <a href="#">
                                    <span class="photo"><?php echo $this->Html->image('../images/avatar-mini-4.jpg'); ?></span>
                                    <span class="subject">
                                        <span class="from">Mr. Perfect</span>
                                        <span class="time">2 hour ago</span>
                                    </span>
                                    <span class="message">
                                        Hi there, its a test
                                    </span>
                                </a>
                            </li>
                            <li>
                                <a href="#">Ver Todas as Mensagens</a>
                            </li>
                        </ul>
                    </li>
                    <!-- inbox dropdown end -->
                    <!-- notification dropdown start-->
                    <li id="header_notification_bar" class="dropdown">
                        <a data-toggle="dropdown" class="dropdown-toggle" href="#">

                            <i class="fa fa-bell-o"></i>
                            <span class="badge bg-warning">3</span>
                        </a>
                        <ul class="dropdown-menu extended notification">
                            <li>
                                <p>Notificações</p>
                            </li>
                            <li>
                                <div class="alert alert-info clearfix">
                                    <span class="alert-icon"><i class="fa fa-bolt"></i></span>
                                    <div class="noti-info">
                                        <a href="#"> Server #1 overloaded.</a>
                                    </div>
                                </div>
                            </li>
                            <li>
                                <div class="alert alert-danger clearfix">
                                    <span class="alert-icon"><i class="fa fa-bolt"></i></span>
                                    <div class="noti-info">
                                        <a href="#"> Server #2 overloaded.</a>
                                    </div>
                                </div>
                            </li>
                            <li>
                                <div class="alert alert-success clearfix">
                                    <span class="alert-icon"><i class="fa fa-bolt"></i></span>
                                    <div class="noti-info">
                                        <a href="#"> Server #3 overloaded.</a>
                                    </div>
                                </div>
                            </li>

                        </ul>
                    </li>
                    <!-- notification dropdown end -->
                </ul>
                <!--  notification end -->
            </div>
            <div class="top-nav clearfix">
                <!--search & user info start-->
                <ul class="nav pull-right top-menu">
                    <li>
                        <input type="text" class="form-control search" placeholder=" Procurar">
                    </li>
                    <!-- user login dropdown start-->
                    <li class="dropdown">
                        <a data-toggle="dropdown" class="dropdown-toggle" href="#">
                            <?php 
                                $profile = FULL_BASE_URL.$this->webroot.'files/profile/'.$this->Session->read('User.id').'.jpg';
                                if (!file_exists(WWW_ROOT.'files/profile/'.$this->Session->read('User.id').'.jpg')) {
                                    echo $this->Html->image('default_large.png', array('width' => 33));
                                } else {
                                    echo $this->Html->image($profile, array('width' => 33));
                                }
                            ?>
                            <span class="username"><?php echo $this->Session->read('User.nome'); ?></span>
                            <b class="caret"></b>
                        </a>
                        <ul class="dropdown-menu extended logout">
                            <li><a href="#"><i class=" fa fa-suitcase"></i>Perfil</a></li>
                            <li><a href="#"><i class="fa fa-cog"></i> Configurações</a></li>
                            <li><a href="<?php echo $this->Html->url(array('plugin' => '', 'controller' => 'users', 'action' => 'logout')); ?>"><i class="fa fa-key"></i> Sair</a></li>
                        </ul>
                    </li>
                    <!-- user login dropdown end -->
                </ul>
                <!--search & user info end-->
            </div>
        </header>
        <!--header end-->
        <!--sidebar start-->
        <aside>
            <div id="sidebar" class="nav-collapse">
                <!-- sidebar menu start-->
                <ul class="sidebar-menu" id="nav-accordion">
                    <li>
                        <a class="active" href="<?php echo $this->Html->url('/'); ?>">
                            <i class="fa fa-dashboard"></i>
                            <span>Painel Inicial</span>
                        </a>
                    </li>
                    <li class="sub-menu">
                        <a href="javascript:;">
                            <i class="fa fa-archive"></i>
                            <span>Secretaria</span>
                        </a>
                        <ul class="sub">
                            <li><a onclick="ajaxload('<?php echo $this->Html->url(array('plugin' => '', 'controller' => 'users', 'action' => 'index')); ?>');" href="javascript:;" >Usuários</a></li>
                            <li><a onclick="ajaxload('<?php echo $this->Html->url(array('plugin' => 'secretaria', 'controller' => 'atas', 'action' => 'index')); ?>');" href="javascript:;" >Atas</a></li>
                            <li><a onclick="ajaxload('<?php echo $this->Html->url(array('plugin' => 'secretaria', 'controller' => 'membros', 'action' => 'index')); ?>');" href="javascript:;" >Membros</a></li>
                            <li><a onclick="ajaxload('<?php echo $this->Html->url(array('plugin' => 'secretaria', 'controller' => 'congregacaos', 'action' => 'index')); ?>');" href="javascript:;" >Congregações</a></li>
                            <li><a onclick="ajaxload('<?php echo $this->Html->url(array('plugin' => 'secretaria', 'controller' => 'visitantes', 'action' => 'index')); ?>');" href="javascript:;" >Visitantes</a></li>
                            <li><a href="javascript:;" onclick="ajaxload('<?php echo $this->Html->url(array('plugin' => 'secretaria', 'controller' => 'profissaos', 'action' => 'index')); ?>');">Profissões</a></li>
                            <li><a href="javascript:;" onclick="ajaxload('<?php echo $this->Html->url(array('plugin' => 'secretaria', 'controller' => 'cargos', 'action' => 'index')); ?>');">Cargos</a></li>
                            <li><a href="javascript:;" onclick="ajaxload('<?php echo $this->Html->url(array('plugin' => 'secretaria', 'controller' => 'calendarios', 'action' => 'add')); ?>');">Calendario</a></li>
                            <li><a onclick="<?php echo $this->Html->url(array('controller' => 'secretaria', 'action' => 'relatorios')); ?> href="javascript:;"">Relatórios</a></li>
                        </ul>
                    </li>
                    <li class="sub-menu">
                        <a href="javascript:;">
                            <i class="fa fa-dollar"></i>
                            <span>Financeiro</span>
                        </a>
                        <ul class="sub">
                            <li><a href="">Lançamentos</a></li>
                            <li><a href="">Cadastros</a></li>
                            <li><a href="">Relatórios</a></li>
                            <li><a href="">Gráficos</a></li>
                        </ul>
                    </li>
                    <li>
                        <a href="fontawesome.html">
                            <i class="fa fa-bullhorn"></i>
                            <span>Ícones para desenvolvimento </span>
                        </a>
                    </li>
                    <li class="sub-menu">
                        <a href="javascript:;">
                            <i class="fa fa-sitemap"></i>
                            <span>Patrimônios</span>
                        </a>
                        <ul class="sub">
                            <li><a href="basic_table.html">Basic Table</a></li>
                            <li><a href="responsive_table.html">Responsive Table</a></li>
                            <li><a href="dynamic_table.html">Dynamic Table</a></li>
                            <li><a href="editable_table.html">Editable Table</a></li>
                        </ul>
                    </li>
                    <li class="sub-menu">
                        <a href="javascript:;">
                            <i class="fa fa-group"></i>
                            <span>Recursos Humanos</span>
                        </a>
                        <ul class="sub">
                            <li><a href="form_component.html">Form Elements</a></li>
                            <li><a href="advanced_form.html">Advanced Components</a></li>
                            <li><a href="form_wizard.html">Form Wizard</a></li>
                            <li><a href="form_validation.html">Form Validation</a></li>
                            <li><a href="file_upload.html">Muliple File Upload</a></li>
                            <li><a href="dropzone.html">Dropzone</a></li>
                        </ul>
                    </li>
                    <li>
                        <a href="mail.html">
                            <i class="fa fa-envelope"></i>
                            <span>Mensagens </span>
                        </a>
                    </li>
                    <li class="sub-menu">
                        <a href="javascript:;">
                            <i class=" fa fa-book"></i>
                            <span>Escola Bíblica</span>
                        </a>
                        <ul class="sub">
                            <li><a href="">Classes</a></li>
                            <li><a href="">Professores</a></li>
                            <li><a href="">Alunos</a></li>
                            <li><a href="">Relatórios</a></li>
                        </ul>
                    </li>
                </ul>
                <!-- sidebar menu end-->
            </div>
        </aside>
        <!--sidebar end-->
        <!--main content start-->
        <section id="main-content">
            <section class="wrapper">
                <?php echo $this->fetch('content'); ?>
            </section>
        </section>
    </section>
    <!--main content end-->
</section>
<!-- Placed js at the end of the document so the pages load faster -->
<!--Core js-->
<?php

    /*
     * Responsável por carregar todos os scripts js básicos do site
     * Todo script que não for específico por alguma coisa, carregar aqui
     */
    echo $this->Html->script(array(
        'lib/jquery.js',
        'bootstrap.min.js',
        '../css/assets/jquery-ui/jquery-ui-1.10.1.custom.min.js',        
        'accordion-menu/jquery.dcjqaccordion.2.7.js',
        'scrollTo/jquery.scrollTo.min.js',
        'nicescroll/jquery.nicescroll.js',
        '../css/assets/jQuery-slimScroll-1.3.0/jquery.slimscroll.js',
        '../css/assets/skycons/skycons',
        '../css/assets/jquery.scrollTo/jquery.scrollTo.js',
        'jquery.easing.min.js',
        '../css/assets/calendar/clndr',
        '../css/assets/calendar/moment-2.2.1',
        'calendar/evnt.calendar.init',
        '../css/assets/jvector-map/jquery-jvectormap-1.2.2.min',
        '../css/assets/jvector-map/jquery-jvectormap-us-lcc-en',
        '../css/assets/gauge/gauge',
        '../css/assets/css3clock/js/script',
        '../css/assets/sparkline/jquery.sparkline.js', 
        '../css/assets/morris-chart/morris',
        '../css/assets/morris-chart/raphael-min',
        '../css/assets/flot-chart/jquery.flot.js',
        '../css/assets/flot-chart/jquery.flot.tooltip.min.js',
        '../css/assets/flot-chart/jquery.flot.resize.js',
        '../css/assets/flot-chart/jquery.flot.pie.resize.js',
        '../css/assets/flot-chart/jquery.flot.animator.min',
        '../css/assets/flot-chart/jquery.flot.growraf',
        'dashboard',
        'custom-select/jquery.customSelect.min',
        '../css/assets/gritter/js/jquery.gritter.js',
        'toggle-button/toggle-init.js',
        'accordion-menu/jquery.dcjqaccordion.2.7',
        'scrollTo/jquery.scrollTo.min',
        'nicescroll/jquery.nicescroll',
        'accordion-menu/jquery.dcjqaccordion.2.7.js', 
        '../css/assets/jquery-ui/jquery-ui-1.10.1.custom.min',
        '../css/assets/jQuery-slimScroll-1.3.0/jquery.slimscroll', 
        '../css/assets/jquery.scrollTo/jquery.scrollTo', 
        '../css/assets/bootstrap-inputmask/bootstrap-inputmask.min.js', 
        '../css/assets/jquery-tags-input/jquery.tagsinput.js',
        'scripts',
        '../css/assets/sparkline/jquery.sparkline',
        '../css/assets/easypiechart/jquery.easypiechart.js',
        '../css/assets/bootstrap-switch-master/build/js/bootstrap-switch.js',
        '../css/assets/fuelux/js/spinner.min.js',
        '../css/assets/bootstrap-fileupload/bootstrap-fileupload.js',
        '../css/assets/bootstrap-wysihtml5/wysihtml5-0.3.0.js',
        '../css/assets/bootstrap-wysihtml5/bootstrap-wysihtml5.js',
        '../css/assets/bootstrap-datepicker/js/bootstrap-datepicker.js',
        '../css/assets/bootstrap-datetimepicker/js/bootstrap-datetimepicker.js',
        '../css/assets/bootstrap-daterangepicker/moment.min.js',
        '../css/assets/bootstrap-daterangepicker/daterangepicker.js',
        '../css/assets/bootstrap-colorpicker/js/bootstrap-colorpicker.js',
        '../css/assets/bootstrap-timepicker/js/bootstrap-timepicker.js',
        'gritter/gritter.js',
        'pace.js',
        '../css/assets/flot-chart/jquery.flot', 
        '../css/assets/flot-chart/jquery.flot.tooltip.min', 
        '../css/assets/flot-chart/jquery.flot.resize', 
        '../css/assets/flot-chart/jquery.flot.pie.resize',
        'jquery.form.js',
        'select2',
        'select-init',
        'bootstrap-switch.js',
        '../css/assets/jquery-multi-select/js/jquery.multi-select.js',
        '../css/assets/jquery-multi-select/js/jquery.quicksearch.js',
        'underscore-min.js',
        //'underscore-min.map.js',
        'advanced-form/advanced-form.js',
        ));
?>
<!--[if lte IE 8]><script language="javascript" type="text/javascript" src="js/flot-chart/excanvas.min.js"></script><![endif]-->
<!--script for this page-->
<a href="javascript:;" onclick="ajaxload(urlLoc);" style="display: none;" id="linkatual"></a>
</body>
</html>