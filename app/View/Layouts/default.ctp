<!DOCTYPE html>
<html>
<head>
  <title>NFCHURCH - Home</title>
  <meta charset="utf8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <!-- Bootstrap -->
  <?php 
    echo $this->Html->css(array('bootstrap.min', 'datepicker', 'nfchurch'));
    echo $this->Html->script(array('jquery', 'bootstrap', 'bootstrap-datepicker', 'jquery.autocomplete', 'jquery.mockjax', 'countries', 'demo'));
  ?>
  <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
  <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
  <!--[if lt IE 9]>
  <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
  <script src="https://oss.maxcdn.com/libs/respond.js/1.3.0/respond.min.js"></script>
  <![endif]-->
  <!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
  
  <!-- Include all compiled plugins (below), or include individual files as needed -->
  <script type="text/javascript">
    $(function() {
      //evento de to-top do layout
      $(window).scroll(function() {
        if($(this).scrollTop() != 0) {
          $('#toTop').fadeIn();
        } else {
          $('#toTop').fadeOut();
        }
      });
      //funcao de click do to-top
      $('#toTop').click(function() {
        $('body,html').animate({scrollTop:0},800);
        //console.debug(voares);
      }); 
    });

    //auto-complete de profissoes
    //$('.typeahead .profissao').typeahead({                                
    //  name: 'profissao',                                                          
    //  prefetch: '../data/countries.json',                                         
    //  limit: 10                                                                   
    //});

    $(function() {
      // Evento de clique do elemento: ul#menu li.parent > a
      $('ul#menu li.parent > a').click(function() {
        // Expande ou retrai o elemento ul.sub-menu dentro do elemento pai (ul#menu li.parent)
        $('ul.sub-menu', $(this).parent()).slideToggle('fast', function() {
          // Depois de expandir ou retrair, troca a classe 'aberto' do <a> clicado       
          $(this).parent().toggleClass('aberto');
        });
      return false;
      });
    });
  </script>
</head>
<body style="margin-top: 3.6em;">
  <header class="navbar navbar-inverse navbar-fixed-top bs-docs-nav col-md-12" role="banner">
    <div class="container logo">
      <div class="navbar-header">
        <button class="navbar-toggle" type="button" data-toggle="collapse" data-target=".bs-navbar-collapse">
          <span class="sr-only">Navegação de Jesus</span>
          <span class="icon-bar"></span>
          <span class="icon-bar"></span>
          <span class="icon-bar"></span>
        </button>
        <a href="#" class="navbar-brand">NFCHURCH</a>
      </div>
      <nav class="collapse navbar-collapse bs-navbar-collapse" role="navigation">
        <ul class="nav navbar-nav">
          <li class="active"><?php echo $this->Html->link('Home Page', array('plugin' => null, 'controller' => 'pages', 'action' => 'home')); ?></li>
          <li><a href="#">Minha conta</a></li>
          <li><a href="#">Components</a></li>
          <li><a href="#">JavaScript</a></li>
          <li><a href="#">Customize</a></li>
        </ul>
        <ul class="nav navbar-nav navbar-right">
          <li><a href="#">Sair</a></li> 
        </ul>
      </nav>
    </div>
  </header>
  <div class="container col-md-12">
    <div class="bs-sidebar hidden-print affix lateral" role="complementary">
      <ul id="menu" class="nav bs-sidenav">
        <li class="parent"><a href="#"><span class="glyphicon glyphicon-briefcase"></span> Secretaria</a>
          <ul class="sub-menu">
            <li><?php echo $this->Html->link('Pessoas', array('plugin' => 'secretaria', 'controller' => 'pessoas', 'action' => 'index'));?></li>
            <li><?php echo $this->Html->link('Cadastros', array('plugin' => 'secretaria', 'controller' => 'pessoas', 'action' => 'add'));?></li>
            <li><?php echo $this->Html->link('Relatórios', array('plugin' => 'secretaria', 'controller' => 'relatorios', 'action' => 'membros'));?></li>
          </ul>
        </li>
        <li class="parent"><a href="#"><span class="glyphicon glyphicon-book"></span> Financeiro</a>
          <ul class="sub-menu">
            <li><?php echo $this->Html->link('Lançamentos', array('plugin' => 'financeiro', 'controller' => 'controle', 'action' => 'visualizar'));?></li>
            <li><?php echo $this->Html->link('Cadastros', array('plugin' => 'secretaria', 'controller' => 'relatorios', 'action' => 'teste'));?></li>
            <li><?php echo $this->Html->link('Relatórios', array('plugin' => 'secretaria', 'controller' => 'relatorios', 'action' => 'teste'));?></li>
            <li><?php echo $this->Html->link('Gráficos', array('plugin' => 'secretaria', 'controller' => 'relatorios', 'action' => 'teste'));?></li>
          </ul>
        </li>
        <li><a href="#"><span class="glyphicon glyphicon-usd"></span> Biblioteca</a></li>
        <li class="parent"><a href="#"><span class="glyphicon glyphicon-folder-close"></span> RH</a>
          <ul class="sub-menu">
            <li><?php echo $this->Html->link('Cadastros', array('plugin' => 'financeiro', 'controller' => 'controle', 'action' => 'teste'));?></li>
            <li><?php echo $this->Html->link('Relatórios', array('plugin' => 'financeiro', 'controller' => 'controle', 'action' => 'teste'));?></li>
          </ul>
        </li>
        <li class="parent"><a href="#"><span class="glyphicon glyphicon-star"></span> EBD</a>
          <ul class="sub-menu">
            <li><?php echo $this->Html->link('Classes', array('plugin' => 'financeiro', 'controller' => 'controle', 'action' => 'teste'));?></li>
            <li><?php echo $this->Html->link('Professores', array('plugin' => 'financeiro', 'controller' => 'controle', 'action' => 'teste'));?></li>
            <li><?php echo $this->Html->link('Alunos', array('plugin' => 'financeiro', 'controller' => 'controle', 'action' => 'teste'));?></li>
            <li><?php echo $this->Html->link('Relatórios', array('plugin' => 'financeiro', 'controller' => 'controle', 'action' => 'teste'));?></li>
          </ul>
        </li>
        <li><a href="#"><span class="glyphicon glyphicon-list-alt"></span> Relatórios e Gráficos</a></li>
        <li><a href="#"><span class="glyphicon glyphicon-tower"></span> Patrimônios</a></li>
        <li><a href="#"><span class="glyphicon glyphicon-comment"></span> Mensagens</a></li>
      </ul>
    </div>
    <div class="all col-md-11"><!-- all -->
      <?php echo $this->fetch('content'); ?>
    </div><!-- /all -->
  </div>
  <div class="btn btn-info" id="toTop"><span id="voar">Ao Topo</span></div>
  <div id="myModal" class="modal fade">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
          <h4 class="modal-title">Cadastrar Nova Profissão</h4>
        </div>
        <div class="modal-body">
          <div class="form-group col-md-12">
            <label for="novaProfissao">Nova Profissão</label>
            <input id="novaProfissao" name="novaProfissao" class="form-control" placeholder="Digite a nova profissão">
          </div>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
          <button type="button" class="btn btn-primary">Save changes</button>
        </div>
      </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
  </div><!-- /.modal -->
</body>
</html>