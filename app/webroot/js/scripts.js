$(window).bind('popstate', function(event) {
    // if the event has our history data on it, load the page fragment with AJAX
    var state = event.originalEvent.state;
    if (state) {
        ajaxload(state);
    }
});
//left side accordion
$(function() {
    $("#apagar").on('click', function() {
        $("#confirmacaoExclusao").modal();
        var countremov = $('input[type="checkbox"]:checked').length-1;
        $('input[type="checkbox"]:checked').each(function(i){
            apagaRegistrosChecked($(this).val());

            if (i == countremov) {
                $("#modalapagar").html('Registro removido com sucesso!');
                $("#confirmacaoExclusao").modal("hide");
            }
        });   
    });
    //Substitui mais de uma ocorrencia em uma string
    String.prototype.replaceAll = function(de, para){
        var str = this;
        var pos = str.indexOf(de);
        while (pos > -1){
            str = str.replace(de, para);
            pos = str.indexOf(de);
        }
        return (str);
    }

    $.fn.outerHTML = function() {
        return this[0].outerHTML || $(this).wrap('<div/>').parent().html() || this;
    };

    $('#nav-accordion').dcAccordion({
        eventType: 'click',
        autoClose: true,
        saveState: true,
        disableLink: true,
        speed: 'slow',
        showCount: false,
        autoExpand: true,
        classExpand: 'dcjq-current-parent'
    });

    
    /* 
     * Para ativar a função em algum elemento, coloque a classe "menuRoll" sobre a mesma
     * Se não funcionar, verifique a classe que verifica se aquele elemento já chegou no TOP. Obrigado
     * Se não funcionar ainda, esquece, vai pro google.
     */

    //verifica o tamanho da janela do navegador/dispositivo do cliente
    var windowMax = $(document).width();   

    if (windowMax > 765) {

        //cria a função que cria o box flutuante de opções
        var stickyNaves = function() {  
            var scrollTop = $(window).scrollTop();
            var topCss = $(".brand").css("height");
            topCss = topCss.replace('px', '');
            var novoTopCss = parseInt(topCss) - 30;

            if (scrollTop > novoTopCss) {

                var cssAdd = $(".breadcrumb").css("width");
                var marginActive = (topCss * -1) + 20;
                marginActive = marginActive + 'px';
                $('.menuRoll').addClass('navBares').css("width", cssAdd).css("margin-top", marginActive);

                var heightFix = $(".menuRoll").css("height");
                $('.menuRollNext').css("margin-top", heightFix);

            } else {  
                $('.menuRoll').removeClass('navBares').removeAttr('style');
                $('.menuRollNext').css("margin-top", 0);
            }
        };

        stickyNaves();  

        $(window).scroll(function() {  
            stickyNaves(); 
        });
    }
});


var Script = function () {

    //  menu auto scrolling

    jQuery('#sidebar .sub-menu > a').click(function () {
        var o = ($(this).offset());
        diff = 80 - o.top;
        if(diff>0)
            $("#sidebar").scrollTo("-="+Math.abs(diff),500);
        else
            $("#sidebar").scrollTo("+="+Math.abs(diff),500);
    });

    // toggle bar

    $(function() {
        var wd;
        wd = $(window).width();
        function responsiveView() {
            var newd = $(window).width();
            if(newd==wd){
                return true;
            }else{
                wd = newd;
            }
            var wSize = $(window).width();
            if (wSize <= 768) {
                $('#sidebar').addClass('hide-left-bar');

            }
        else{
                $('#sidebar').removeClass('hide-left-bar');
            }

        }
        $(window).on('load', responsiveView);
        $(window).on('resize', responsiveView);




    });

    $('.sidebar-toggle-box .fa-bars').click(function (e) {
        $('#sidebar').toggleClass('hide-left-bar');
        $('#main-content').toggleClass('merge-left');
        e.stopPropagation();
        if( $('#container').hasClass('open-right-panel')){
            $('#container').removeClass('open-right-panel')
        }
        if( $('.right-sidebar').hasClass('open-right-bar')){
            $('.right-sidebar').removeClass('open-right-bar')
        }

        if( $('.header').hasClass('merge-header')){
            $('.header').removeClass('merge-header')
        }



    });
    $('.toggle-right-box .fa-bars').click(function (e) {
        $('#container').toggleClass('open-right-panel');
        $('.right-sidebar').toggleClass('open-right-bar');
        $('.header').toggleClass('merge-header');

        e.stopPropagation();
    });

    $('.header,#main-content,#sidebar').click(function () {
       if( $('#container').hasClass('open-right-panel')){
           $('#container').removeClass('open-right-panel')
       }
        if( $('.right-sidebar').hasClass('open-right-bar')){
            $('.right-sidebar').removeClass('open-right-bar')
        }

        if( $('.header').hasClass('merge-header')){
            $('.header').removeClass('merge-header')
        }


    });


   // custom scroll bar
    $("#sidebar").niceScroll({styler:"fb",cursorcolor:"#1FB5AD", cursorwidth: '3', cursorborderradius: '10px', background: '#404040', spacebarenabled:false, cursorborder: ''});
    $(".right-sidebar").niceScroll({styler:"fb",cursorcolor:"#1FB5AD", cursorwidth: '3', cursorborderradius: '10px', background: '#404040', spacebarenabled:false, cursorborder: ''});


   // widget tools

    jQuery('.panel .tools .fa-chevron-down').click(function () {
        var el = jQuery(this).parents(".panel").children(".panel-body");
        if (jQuery(this).hasClass("fa-chevron-down")) {
            jQuery(this).removeClass("fa-chevron-down").addClass("fa-chevron-up");
            el.slideUp(200);
        } else {
            jQuery(this).removeClass("fa-chevron-up").addClass("fa-chevron-down");
            el.slideDown(200);
        }
    });

    jQuery('.panel .tools .fa-times').click(function () {
        jQuery(this).parents(".panel").parent().remove();
    });

   // tool tips

    $('.tooltips').tooltip();

    // popovers
    if($('.popovers').length >= 1) {
        $('.popovers').popover();
    }

    // notification pie chart
    $(function() {
        $('.notification-pie-chart').easyPieChart({
            onStep: function(from, to, percent) {
                $(this.el).find('.percent').text(Math.round(percent));
            },
            barColor: "#39b6ac",
            lineWidth: 3,
            size:50,
            trackColor: "#efefef",
            scaleColor:"#cccccc"

        });

    });


    //$(function() {

        //var datatPie = [30,50];
// DONUT
        /*$.plot($(".target-sell"), datatPie,
            {
                series: {
                    pie: {
                        innerRadius: 0.6,
                        show: true,
                        label: {
                            show: false

                        },
                        stroke: {
                            width:.01,
                            color: '#fff'

                        }
                    }




                },

                legend: {
                    show: true
                },
                grid: {
                    hoverable: true,
                    clickable: true
                },

                colors: ["#ff6d60", "#cbcdd9"]
            });*/
    //});

    $(function() {
        $('.pc-epie-chart').easyPieChart({
            onStep: function(from, to, percent) {
                $(this.el).find('.percent').text(Math.round(percent));
            },
            barColor: "#5bc6f0",
            lineWidth: 3,
            size:50,
            trackColor: "#32323a",
            scaleColor:"#cccccc"

        });

    });



    $(function() {
        $(".d-pending").sparkline([3,1], {
            type: 'pie',
            width: '40',
            height: '40',
            sliceColors: ['#e1e1e1','#8175c9']
        });
    });



// SPARKLINE
    $(function () {
        var sparkLine = function () {
            $(".sparkline").each(function(){
                var $data = $(this).data();
                ($data.type == 'pie') && $data.sliceColors && ($data.sliceColors = eval($data.sliceColors));
                ($data.type == 'bar') && $data.stackedBarColor && ($data.stackedBarColor = eval($data.stackedBarColor));

                $data.valueSpots = {'0:': $data.spotColor};
                $(this).sparkline( $data.data || "html", $data);


                if($(this).data("compositeData")){
                    $spdata = $(this).data("compositeConfig");
                    $spdata.composite = true;
                    $spdata.minSpotColor = false;
                    $spdata.maxSpotColor = false;
                    $spdata.valueSpots = {'0:': $spdata.spotColor};
                    $(this).sparkline($(this).data("compositeData"), $spdata);
                };
            });
        };

        var sparkResize;
        $(window).resize(function (e) {
            clearTimeout(sparkResize);
            sparkResize = setTimeout(function () {
                sparkLine(true)
            }, 500);
        });
        sparkLine(false);
    });

    /*==Collapsible==*/
    $(function() {
        $('.widget-head').click(function(e)
        {
            var widgetElem = $(this).children('.widget-collapse').children('i');

            $(this)
                .next('.widget-container')
                .slideToggle('slow');
            if ($(widgetElem).hasClass('ico-minus')) {
                $(widgetElem).removeClass('ico-minus');
                $(widgetElem).addClass('ico-plus');
            }
            else
            {
                $(widgetElem).removeClass('ico-plus');
                $(widgetElem).addClass('ico-minus');
            }
            e.preventDefault();
        });

    });

//    $(function() {
//
//    $('.todo-check label').click(function(){
//        var n = $(this).parents('li input[type="checkbox"]');
//        if ($(n).is(':checked')){
//alert('tets');
//        }
//        else{
//            alert('none');
//        }
//
//    });
//
//    });
}();

//função que faz marcar todos os checkbox dentro de uma div
function MarcarTodos(div, checked)
{

    /*
     * Função que faz selecionar todos os checkbox de uma vez e deschecar
     */
    if (checked == true) {
        $('#'+div+' input[type=checkbox]').prop('checked', true);
    } else {
        $('#'+div+' input[type=checkbox]').prop('checked', false);
    }
}

var urlLoc;
function ajaxload(url)
{

    /* 
     * Função que faz a barra de progresso entrar em ação
     * Depois que a barra de progresso entrar em ação, faz com que carregue uma view na div ".wrapper"
     */

    pathArray = window.location.href.split( '/' );
    protocol = pathArray[0];
    host = pathArray[2];

    url = url.replace(protocol+'//'+host, '');

    urlhistory = protocol+'//'+host+url;

    history.pushState(urlhistory, "TESTE", urlhistory);

    $(".wrapper").removeAttr('style');
    urlLoc = url;
    $(".wrapper").html(''); // Apaga todo o HTML da div ".wrapper"
    setTimeout(function(){
        $(".wrapper").load(url, function() {
            Pace.start(), Pace.stop();
            var minHeight = $(".wrapper").css("height");
            $(".wrapper").css("min-height", minHeight);
            multiSelect();

            $("#apagar").on('click', function() {
                $("#confirmacaoExclusao").modal();
                var countremov = $('input[type="checkbox"]:checked').length-1;
                $('input[type="checkbox"]:checked').each(function(i){
                    apagaRegistrosChecked($(this).val());

                    if (i == countremov) {
                        $("#modalapagar").html('Registro removido com sucesso!');
                        $("#confirmacaoExclusao").modal("hide");
                    }
                });   
            });
        })
    }, 300);
};
function multiSelect()
{
    $('.multi-select').multiSelect({
      selectableHeader: "<input type='text' class='form-control' autocomplete='off'>",
      selectionHeader: "<input type='text' class='form-control' autocomplete='off'>",
      afterInit: function(ms){
        var that = this,
            $selectableSearch = that.$selectableUl.prev(),
            $selectionSearch = that.$selectionUl.prev(),
            selectableSearchString = '#'+that.$container.attr('id')+' .ms-elem-selectable:not(.ms-selected)',
            selectionSearchString = '#'+that.$container.attr('id')+' .ms-elem-selection.ms-selected';

        that.qs1 = $selectableSearch.quicksearch(selectableSearchString)
        .on('keydown', function(e){
          if (e.which === 40){
            that.$selectableUl.focus();
            return false;
          }
        });

        that.qs2 = $selectionSearch.quicksearch(selectionSearchString)
        .on('keydown', function(e){
          if (e.which == 40){
            that.$selectionUl.focus();
            return false;
          }
        });
      },
      afterSelect: function(){
        this.qs1.cache();
        this.qs2.cache();
      },
      afterDeselect: function(){
        this.qs1.cache();
        this.qs2.cache();
      }
    });
}

// Variable to store your files
var files;
 
// Grab the files and set them to our variable
function prepareUpload(event)
{
  files = event.target.files;
}

var url_target;
function modalLoad(url)
{

    /*
     * Defino as variáveis de destino para a página ser carregada dentro do Modal
     * Obrigado.
     */

    //defini o caminho onde vai pegar os inputs de ADD
    url_target = url;

    $.get(url, function(data) {
        $("#myModal .modal-body").html(data);
        //jQuery.noConflict();
        $("#myModal").modal("show");
        $(".datepicker").css('margin-top', '0px !important');
        $('input[type=file]').on('change', prepareUpload);

        $(".desable-form input, .desable-form select, .desable-form textarea, .desable-form radio, .desable-form checkbox").attr('disabled','disabled');
        $(".habilita_campos").on('click', function(){
            $("input, select, textarea, radio, checkbox").removeAttr('disabled');
            //$("#futuro-salvar").attr('class', 'btn btn-primary').attr('data-toggle', 'modal').removeAttr('id').attr('href', '#confirmar').html('Salvar dados');
            $("#futuro-salvar").remove();
            $(".habilita_campos").remove();
            $("#msg_block").remove();
            $("#salvar-dados").removeAttr("style");
            $("#salvar-dados").on('click', function() {
                $('#myModal').animate({ scrollTop: 0 }, 'slow');
            });
            $(".disabled").removeClass("disabled");
        });
        $(".nao-salvar").on('click', function() {
            $("#confirmar").modal('hide');
        });

        /*
         * Script que salva o form via ajax com requisição POST
         * Não usamos o proprio do jquery pelo fato dele não mandar a requisição que o CakePHP precisa
         * 
         */


        $(".formModal").on('submit', function(e)
        {
            if ($("#UserPassword").val() == $("#UserRepassword").val()) {
                var postData = $(this).serializeArray();
                var formURL = $(this).attr("action");

                var form = $('.formModal')[0];
                var formData = new FormData(form);
                
                $.ajax(
                {
                    url : formURL,
                    type: "POST",
                    data : formData,
                    processData: false, // Don't process the files
                    contentType: false, // Set content type to false as jQuery will tell the server its a query string request
                    success:function(data, textStatus, jqXHR) 
                    {                       
                        $('#confirmar').modal('hide');
                        $("#myModal").modal("hide");
                        $('body').removeClass('modal-open');
                        $('.modal-backdrop').remove();                    
                        
                        e.stopPropagation();
                        ajaxload(urlLoc);                    
                    },
                    error: function(jqXHR, textStatus, errorThrown) 
                    {
                        console.debug('Criar nova Action!!!!!!!!11onze');
                    }
                });
            } else {
                alert("Senha não confere, \nfavor digite novamente!");
            }
            e.preventDefault(); //STOP default action
        });
    });

    return false;   
};


function modalLoadAdd(url, atualizar_para, atualizar_de)
{

    /*
     * Defino as variáveis de destino para a página ser carregada dentro do Modal
     * Obrigado.
     * @var atualizar_para: é o destino do conteudo
     * @var atualizar_de: é o objeto que o script vai acessar para pegar os dados
     * @var url: é o caminho que do conteudo que vai ser incluso no body do modal
     */
    $.get(url, function(data) {
        $("#add_item .modal-body").html(data);

        $('html, body, #myModal').animate({scrollTop : 0}, 800);

        //salvar_dados
        //jQuery.noConflict();
        $("#add_item").modal("show");

        $('.fecha-modal').css("display", "hidden");

        $('.fecha-modal').html('<button class="btn btn-default form-control nao-salvar" type="button">Fechar</button>');

        $(".nao-salvar").on('click', function() {
            $("#add_item").modal('hide');
        });

        /*
         * Script que salva o form via ajax com requisição POST
         * Não usamos o proprio do jquery pelo fato dele não mandar a requisição que o CakePHP precisa
         * 
         */
        $(".formModal").on('submit', function(e)
        {
            var postData = $(this).serializeArray();
            var formURL = $(this).attr("action");
            $.ajax(
            {
                url : formURL,
                type: "POST",
                data : postData,
                success:function(data, textStatus, jqXHR) 
                {
                    atualizaItem(url_target, atualizar_para, atualizar_de);
                    $("#add_item").modal("hide");
                    e.stopPropagation();
                },
                error: function(jqXHR, textStatus, errorThrown)
                {
                    console.debug('erro do brunaos');
                }
            });
            e.preventDefault(); //STOP default action
        });
    });
    

    return false;   
};

function atualizaItem(target, atualizar_para, atualizar_de) 
{
    $("#"+atualizar_para).load(target+"  #"+atualizar_de+" option");
}

function removeParente(id) {
    $("#"+id).remove();
}

function apagaRelacionamento(campo, div, url) {
    var valor = $("#"+campo).val();

    $.ajax(
    {
        url : url+'/'+valor,
        type: "POST",
        data : {id: valor},
        success:function(data, textStatus, jqXHR) 
        {
            $("#"+div).remove();
        },
        error: function(jqXHR, textStatus, errorThrown)
        {
            console.debug('erro do brunaos');
        }
    });
}