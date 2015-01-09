<?php 
    if ($_POST) {
        $nome = $_POST['nome'];
        $email = $_POST['email'];
        $telefone = $_POST['telefone'];
        $mensagem = $_POST['mensagem'];

        $msg = "Uma nova mensagem do site NFCHURCH <br /> Nome do contato: ".$nome."<br />Email: ".$email."<br /> Telefone: ".$telefone."<br />Mensagem: ".$mensagem;

        mail('analistadenegocios@nfservice.com.br', 'Contato do site NFCHURCH', $msg);
        echo '<script>alert("Mensagem enviada com sucesso\n Vamos te responder o mais rápiudo possível");</script>';
    }
?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">
    <link rel="icon" href="../../favicon.ico">

    <title>NFChurch - Primeiro software Open Source para gestão de igrejas</title>

    <!-- Bootstrap core CSS -->
    <link href="css/bootstrap.css" rel="stylesheet">
    
    <link rel="stylesheet" type="text/css" href="css/responsive-slider.css">

    <!-- Custom styles for this template -->
    <link href="css/theme_nfchurch.css" rel="stylesheet">

    <!-- Just for debugging purposes. Don't actually copy these 2 lines! -->
    <!--[if lt IE 9]><script src="../../assets/js/ie8-responsive-file-warning.js"></script><![endif]-->
    <script src="js/ie-emulation-modes-warning.js"></script>

    <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
    <!--[if lt IE 9]>
        <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
        <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
        <![endif]-->

        <link href='http://fonts.googleapis.com/css?family=Josefin+Sans' rel='stylesheet' type='text/css'>
        <link href="//maxcdn.bootstrapcdn.com/font-awesome/4.2.0/css/font-awesome.min.css" rel="stylesheet">

        
  </head>

  <body role="document">

    <!-- Fixed navbar -->
    <nav class="navbar navbar-inverse navbar-fixed-top">
        <div class="container">
            <div class="navbar-header">
                <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar" aria-expanded="false" aria-controls="navbar">
                    <span class="sr-only">Navegação</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>
                <a class="navbar-brand" href="#">NFCHURCH - Gestão para igrejas</a>
            </div>
            <div id="navbar" class="navbar-collapse collapse">
                <ul class="nav navbar-nav">
                    <li class="active"><a href="#inicio">Início</a></li>
                    <li><a href="#sobre">Sobre</a></li>
                    <li><a href="#contato">Contato</a></li>
                    <li><a href="#" data-toggle="modal" data-target="#modalCadastro">Se Cadastrar</a></li>
                    <li><a href="https://github.com/nfservice/NFChurchWeb" target="_blank">Download</a></li>
                </ul>
                <ul class="nav navbar-nav navbar-right">
                    <li><a href="/sistema">Fazer Login no Sistema</a></li>
                  </ul>
            </div><!--/.nav-collapse -->
        </div>
    </nav>

    <!-- Responsive slider - START -->
    <div class="responsive-slider" data-spy="responsive-slider" data-autoplay="true" id="inicio">
        <div class="slides" data-group="slides">
            <ul>
                <li>
                    <div class="slide-body" data-group="slide">
                        <img src="img/slide-2.jpg">
                        <div class="caption header" style="top: 62%" data-animate="slideAppearRightToLeft" data-delay="500" data-length="300">
                            <h2>NFCHURCH</h2>
                            <div class="caption sub" data-animate="slideAppearLeftToRight" data-delay="500" data-length="500">
                                O Sistema de Gestão ideal para a sua Igreja.
                            </div>
                        </div>

                        <div class="caption header" style="top: 52%" data-animate="slideAppearRightToLeft" data-delay="500" data-length="300">
                            <a href="cadastro" class="btn btn-lg btn-success"><i class="fa fa-check"></i> Faça seu cadastro e use gratuitamente.</a>
                        </div>
                        <!--<div class="caption img-html5" data-animate="slideAppearLeftToRight" data-delay="200">
                            <img src="img/html5.png">
                        </div>
                        <div class="caption img-css3" data-animate="slideAppearLeftToRight">
                            <img src="img/css3.png">
                        </div>-->
                    </div>
                </li>
                <li>
                    <div class="slide-body" data-group="slide">
                        <img src="img/slide-1.jpg">
                        <div class="caption header" style="top: 42%; left: 6%; " data-animate="slideAppearRightToLeft" data-delay="500" data-length="300">
                            <h2>RESPONSIVIDADE</h2>
                            <div class="caption sub" data-animate="slideAppearLeftToRight" data-delay="500" data-length="500">
                                Adequado para qualquer tipo de dispositivo da atualidade.
                            </div>
                        </div>

                        <div class="caption header" style="top: 72%; left: 6%; " data-animate="slideAppearRightToLeft" data-delay="500" data-length="300">
                            <a href="cadastro" class="btn btn-lg btn-success"><i class="fa fa-check"></i> Faça seu cadastro e use gratuitamente.</a>
                        </div>
                    </div>
                </li>
                <!--<li>
                    <div class="slide-body" data-group="slide">
                        <img src="img/slide-3.jpg">
                        <div class="caption header" data-animate="slideAppearRightToLeft" data-delay="500" data-length="300">
                            <h2>Responsividade</h2>
                            <div class="caption sub" data-animate="slideAppearLeftToRight" data-delay="800" data-length="300">O sistema que acompanha a sua modernidade.</div>
                        </div>
                        <div class="caption img-jquery" data-animate="slideAppearDownToUp" data-delay="200">
                            <img src="img/jquery.png">
                        </div>
                    </div>
                </li>-->
            </ul>
        </div>
        <a border="0" class="slider-control left" href="#" data-jump="prev"><</a>
        <a border="0" class="slider-control right" href="#" data-jump="next">></a>
        <div class="pages">
            <a class="page" href="#" data-jump-to="1">1</a>
            <a class="page" href="#" data-jump-to="2">2</a>
        </div>
    </div>
    <!-- Responsive slider - END -->

    <div class="container" role="main">
        <div class="page-header">
            <h1 align="center"> - NFCHURCH - Sistema de Gestão para Igrejas - </h1>
        </div>
        <div class="row">
            <div class="col-md-12">
                <div class="row">
                    <div class="col-md-4">
                        <div class="col-md-3"><i class="fa fa-building fa-5x" style="color: #277193"></i></div>
                        <div class="col-md-9">
                            <p class="titulos">Relatórios</p>
                            <p>Realtório com filtros que vai facilitar o dia-a-dia no gerenciamento de sua igreja.</p>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="col-md-3"><i class="fa fa-archive fa-5x" style="color: #277193"></i></div>
                        <div class="col-md-9">
                            <p class="titulos">Secretaria</p>
                            <p>Temos o módulo de secretaria, onde nele você pode cadastrar usuários, atas, membros, congregações, eventos entre outros cadastros.</p>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="col-md-3"><i class="fa fa-tablet fa-5x" style="color: #277193"></i></div>
                        <div class="col-md-9">
                            <p class="titulos">Responsividade</p>
                            <p>O NFCHURCH foi desenvolvido pensando em todos os dispositivos da atualidade, assim você pode gerenciar sua igreja de onde estiver.</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-md-12">
            <div id="sobre">
                <h1>Sobre a NFCHURCH</h1>
                <p>O NFCHURCH nasceu na necessidade e na vontade de criar um sistema voltado para Deus. Pensando dessa forma, o Setor de Desenvolvimento da empresa <a href="https://www.nfservice.com.br/" target="_blank">NFSERVICE</a> passou a trabalhar com o projeto com intúito de ser grátis para todas as empresas e também como projeto Open Source, ou seja, código livre para qualquer um usar onde precisar.</p>

                <p>Para fazer o download do Código fonte do NFCHURCH, é muito fácil, só clicar <a href="https://github.com/nfservice/NFChurchWeb" target="_blank">Aqui!</a></p>

                <div class="col-md-6">
                    <img src="img/imagem_1.jpg" class="img-responsive img-thumbnail">
                </div>
                <div class="col-md-6">
                    <img src="img/imagem_2.jpg" class="img-responsive img-thumbnail">
                </div>
            </div>
        </div>

        <br /><br /><br />

        <div class="col-md-12">
            <div class="page-header" id="contato">
                <h1>Contato</h1>
                <p>Para entrar em contato conosco, basta preencher todos os campos abaixo e clicar no botão "Enviar Mensagem".</p>
                <p>Vamos te responder o mais rápido possível.</p>              
               <div class="col-md-8 row">
               <br /><br />
                   <form class="row" role="form" action="" method="post">
                        <div class="form-group col-md-12">
                            <label for="nome">Nome</label>
                            <input type="text" name="nome" class="form-control" required>
                        </div>
                        <div class="form-group col-md-12">
                            <label for="nome">Email</label>
                            <input type="email" name="email" class="form-control" required>
                        </div>
                        <div class="form-group col-md-12">
                            <label for="nome">Telefone</label>
                            <input type="text" name="telefone" class="form-control" required>
                        </div>
                        <div class="form-group col-md-12">
                            <label for="nome">Mensagem</label>
                            <textarea class="form-control" name="mensagem" rows="6" required></textarea>
                        </div>
                        <div class="form-group col-md-12">
                            <input type="submit" value="Enviar mensagem" class="btn btn-success form-control">
                        </div>
                   </form>
               </div>

               <div class="col-md-4" style="margin-left: 2%;">
               <br /><br />
                   <p><i class="fa fa-map-marker"></i> Endereço: Rua Washignton Luiz, 250</p>
                   <p><i class="fa fa-clock-o"></i> Horário de atendimento: 8:00 - 12:00 - 13:00 - 17:00. De segunda a Sexta-feira</p>
                   <p><i class="fa fa-phone"></i> Araras: (19) 3542 8677</p>
                   <p><i class="fa fa-phone"></i> São Paulo: (11) 3090 0365</p>
                   <p><i class="fa fa-phone"></i> Santos: (13) 4042 1828</p>
                   <p><i class="fa fa-phone"></i> Campinas: (19) 3090 1424</p>
                   <p><i class="fa fa-phone"></i> Rio de Janeiro: (21) 3090 0013</p>
                   <p><i class="fa fa-phone"></i> Vitória: (27) 4042 1842</p>
                   <p><i class="fa fa-phone"></i> Belo Horizonte: (31) 4042 1992</p>
                   <p><i class="fa fa-phone"></i> Curitiba: (41) 4042 1838</p>
                   <p><i class="fa fa-phone"></i> Porto Alegre: (51) 4042 1922</p>
                   <p><i class="fa fa-phone"></i> Brasília: (61) 3090 0010</p>
                   <p><i class="fa fa-phone"></i> Goiânia: (62) 3142 1802</p>
                   <p><i class="fa fa-phone"></i> Salvador: (71) 4042 1924</p>
                   <p><i class="fa fa-phone"></i> Fortaleza: (85) 4042 1840</p>
                   <p><i class="fa fa-phone"></i> Manaus: (92) 3090 0105</p>
               </div>
            </div>
        </div>
    </div> <!-- /container -->

    <div class="row" style="background-color: #222; color: #eee">
        <h5 align="center">&copy; 2015 NFCHURCH - Todos os direitos reservados</h5>
    </div>

    <!-- Modal -->
    <div class="modal fade" id="modalCadastro" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
      <div class="modal-dialog">
        <div class="modal-content">
          <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
            <h4 class="modal-title" id="myModalLabel">Cadastro NFCHURCH</h4>
          </div>
          <div class="modal-body">
            <form action="../nfchurch/users/addUser" role="form" method="post">
                <div class="form-group">
                    <input type="text" name="data[Church][nome]" class="form-control" required placeholder="Nome da Igreja">
                </div>
                <div class="form-group">
                    <input type="text" name="data[User][nome]" class="form-control" required placeholder="Seu Nome">
                </div>
                <div class="form-group">
                    <input type="email" name="data[User][username]" class="form-control" required placeholder="Seu e-mail">
                </div>
                <div class="form-group">
                    <input type="text" name="data[User][telefone]" class="form-control" placeholder="Telefone">
                </div>
                <div class="form-group">
                    <input type="password" name="data[User][password]" required class="form-control" placeholder="Sua Senha">
                </div>
                <div class="row">
                    <div class="form-group col-md-10">
                        <input type="submit" value="Me Cadastrar" class="form-control btn btn-primary">
                    </div>
                    <div class="form-group col-md-2">
                        <button type="button" class="btn btn-default form-control" data-dismiss="modal">Fechar</button>
                    </div>
                </div>
            </form>
          </div>
          <div class="modal-footer">
          </div>
        </div>
      </div>
    </div>


    <!-- Bootstrap core JavaScript
    ================================================== -->
    <!-- Placed at the end of the document so the pages load faster -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>
    <script src="js/bootstrap.min.js"></script>
    <script src="js/docs.min.js"></script>
    <!-- IE10 viewport hack for Surface/desktop Windows 8 bug -->
    <script src="js/ie10-viewport-bug-workaround.js"></script>
    <script src="js/jquery.event.move.js"></script>
    <script src="js/responsive-slider.js"></script>

    <script type="text/javascript">

    $(document).ready(function () {
        $(document).on("scroll", onScroll);
        
        //smoothscroll
        $('a[href^="#"]').on('click', function (e) {
            e.preventDefault();
            $(document).off("scroll");
            
            $('li').each(function () {
                $(this).removeClass('active');
            })
            $(this).addClass('active');
          
            var target = this.hash,
                menu = target;
            $target = $(target);
            $('html, body').stop().animate({
                'scrollTop': $target.offset().top+2
            }, 500, 'swing', function () {
                window.location.hash = target;
                $(document).on("scroll", onScroll);
            });
        });
    });

    function onScroll(event){
        var scrollPos = $(document).scrollTop();
        $('#navbar ul li a').each(function () {
            var currLink = $(this);
            var refElement = $(currLink.attr("href"));
            console.debug(refElement.position());
            if (refElement.position().top <= scrollPos && refElement.position().top + refElement.height() > scrollPos) {
                $('#navbar ul li').removeClass("active");
                currLink.addClass("active");
            } else {
                currLink.removeClass("active");
            }
        });
    }
    </script>
</body>
</html>
