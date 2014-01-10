<!DOCTYPE html>
<html>
<head>
	<title>NFCHURCH - Home</title>
	<meta charset="utf8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<!-- Bootstrap -->
	

	<!-- <link href="css/nfchurch.css" rel="stylesheet"> -->
	<?php 
		echo $this->Html->script(array('jquery.js', 'bootstrap.min.js'));
		echo $this->Html->css(array('bootstrap.min','nfchurch'));
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
	      var voares = 0;
	      $('#toTop').click(function() {
	      	$('body,html').animate({scrollTop:0},800);
	        //console.debug(voares);
	        voares++;
	        if (voares >= 2) {
	        	$("#voar").text('Subir');
	        }
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
	<div id="container">
		<header class="navbar navbar-inverse navbar-fixed-top bs-docs-nav col-md-12" role="banner">
			<div class="container logo">
				<div class="navbar-header">
					<button class="navbar-toggle" type="button" data-toggle="collapse" data-target=".bs-navbar-collapse">
						<span class="sr-only">Navegação de Jesus</span>
						<span class="icon-bar"></span>
						<span class="icon-bar"></span>
						<span class="icon-bar"></span>
					</button>
					<a href="../" class="navbar-brand">NFCHURCH</a>
				</div>
				<nav class="collapse navbar-collapse bs-navbar-collapse" role="navigation">
					<ul class="nav navbar-nav">
						<li class="active"><a href="#">Home page</a></li>
						<li><a href="#">Minha conta</a></li>
						<li><a href="../components">Components</a></li>
						<li><a href="../javascript">JavaScript</a></li>
						<li><a href="../customize">Customize</a></li>
					</ul>
					<ul class="nav navbar-nav navbar-right">
						<li><a href="#">Sair</a></li>
					</ul>
				</nav>
			</div>
		</header>
		<div class="container col-md-12">
			<div class="bs-sidebar hidden-print affix lateral" role="complementary">
				<ul class="nav bs-sidenav">
					<li class="active"><a href="#overview"><span class="glyphicon glyphicon-book"></span> Biblioteca</a></li>
					<li class="parent"><a href="#"><span class="glyphicon glyphicon-briefcase"></span> Secretaria</a>
						<ul class="sub-menu">
							<li><a href="#" title="">Membros</a></li>  
							<li><a href="#" title="">Outros</a></li>
							<li><a href="#" title="">Outro item de teste</a></li>
						</ul>
					</li>
					<li><a href="#"><span class="glyphicon glyphicon-usd"></span> Financeiro</a></li>
					<li><a href="#"><span class="glyphicon glyphicon-folder-close"></span> RH</a></li>
					<li><a href="#"><span class="glyphicon glyphicon-user"></span> Cadastro de Membros</a></li>
					<li><a href="#"><span class="glyphicon glyphicon-bell"></span> Utilitários</a></li>
					<li><a href="#"><span class="glyphicon glyphicon-star"></span> EBD</a></li>
					<li><a href="#"><span class="glyphicon glyphicon-list-alt"></span> Relatórios e Gráficos</a></li>
					<li><a href="#"><span class="glyphicon glyphicon-tower"></span> Patrimônios</a></li>
					<li><a href="#"><span class="glyphicon glyphicon-comment"></span> Mensagens</a></li>
				</ul>
			</div>
		</div>
		<div class="all col-md-11">

			<div id="content">
				<?php echo $this->fetch('content'); ?>
			</div>

		</div>
	</div>
	<!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
	<script src="https://code.jquery.com/jquery.js"></script>
	<!-- Include all compiled plugins (below), or include individual files as needed -->
	<script src="js/bootstrap.min.js"></script>
</body>
</html>