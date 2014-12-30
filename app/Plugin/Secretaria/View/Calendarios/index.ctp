<div class="row">
    <div class="col-sm-12 col-md-12">
        <section class="panel">
            <header class="panel-heading">
                Eventos
                <span class="tools pull-right">
                    <a href="javascript:;" onClick="modalLoad('<?php echo $this->Html->url(array('action' => 'add')); ?>');" class="fa fa-plus"> Adicionar evento</a>
                 </span>
            </header>
            <div class="panel-body">
                <!-- page start-->
                <div class="row">
                    <aside class="col-lg-12">
                        <section class="panel">
                            <div class="panel-body">
                                <div id="calendar" class="has-toolbar"></div>
                            </div>
                        </section>
                    </aside>
                </div>
                <!-- page end-->
            </div>
        </section>
    </div>
</div>
<?php echo $this->element('modal/modalEdit'); ?>
<script type="text/javascript">
    $(document).ready(function(){
        $('#calendar').fullCalendar({
        // put your options and callbacks here
            header: {
                left: 'prevYear,prev,next,nextYear, today',
                center: 'title',
                right: 'month,basicWeek,basicDay',
            },
            buttonText:{
                prev:     '&lsaquo;', // <
                next:     '&rsaquo;', // >
                prevYear: '&laquo;',  // <<
                nextYear: '&raquo;',  // >>
                today:    'Hoje',
                month:    'Mês',
                week:     'Semana',
                day:      'Dia'
            },

            dayNamesShort:['Dom', 'Seg', 'Ter', 'Qua', 'Qui', 'Sex', 'Sab'],
            monthNamesShort:['Jan', 'Fev', 'Mar', 'Abr', 'Mai', 'Jun', 'Jul', 'Ago', 'Set', 'Out', 'Nov', 'Dez'],

            dayNames:['Domingo', 'Segunda', 'Terça', 'Quarta', 'Quinta', 'Sexta', 'Sábado'],
            monthNames:['Janeiro', 'Fevereiro', 'Março', 'Abril', 'Maio', 'Junho', 'Julho', 'Agosto', 'Setembro', 'Outubro', 'Novembro', 'Dezembro'],

            eventClick: function(calEvent, jsEvent, view) {
                //alert('Coordinates: ' + jsEvent.pageX + ',' + jsEvent.pageY);
                modalLoad('<?php echo $this->Html->url(array('action' => 'edit')); ?>/'+calEvent.id);
                // change the border color just for fun
            },
            timeFormat: 'HH(:mm)' // uppercase H for 24-hour clock
        });
        
        var viewAtual = $('#calendar').fullCalendar('getView');
        loadEvents(viewAtual.visStart, viewAtual.visEnd);
        
        $('.fc-button').click(function(){
            var view = $('#calendar').fullCalendar('getView');
            loadEvents(view.visStart, view.visEnd);
        });
    });
    function loadEvents(inicio, fim) {

        var i = new Date(inicio);
        var f = new Date(fim);

        i = i.toLocaleDateString().split('/').reverse();
        f = f.toLocaleDateString().split('/').reverse();

        i = i[0]+"-"+i[1]+"-"+i[2]+" 00:00:00";
        f = f[0]+"-"+f[1]+"-"+f[2]+" 23:59:59";

        $.ajax({
            url: '<?php echo $this->Html->url(array('action' => 'load_events')) ?>',
            dataType: 'json',
            data: {inicio: i.toString(), fim: f.toString()},
            type: 'post',
            success: function(events){
                $('#calendar').fullCalendar('removeEvents');
                var data;
                for (var i in events) {
                    /*var datainicio = new Date(events[i].Calendario.datainicio);
                    events[i].Calendario.datainicio = datainicio.toLocaleString();

                    if (events[i].Calendario.datafim) {
                        var datafim = new Date(events[i].Calendario.datafim);    
                        events[i].Calendario.datafim = datafim.toLocaleString();
                    }*/
                    events[i].Calendario.datainicio = events[i].Calendario.datainicio.replace('T', ' ');
                    events[i].Calendario.datafim = events[i].Calendario.datafim.replace('T', ' ');

                    data= {
                        id: events[i].Calendario.id,
                        title: events[i].Calendario.assunto,
                        start: events[i].Calendario.datainicio,
                    }
                    if (events[i].Calendario.diatodo == 1) {
                        data.allDay = false;
                    }

                    datafim = events[i].Calendario.datafim.split(' ');

                    if (datafim[0] != '0000-00-00') {
                        end = events[i].Calendario.datafim.split(' ');
                        data.end = end[0]+'T'+end[1];
                    }

                    if (events[i].Calendario.cor) {
                        data.color = events[i].Calendario.cor.toString();
                    };

                    start = events[i].Calendario.datainicio.split(' ');
                    data.start = start[0]+'T'+start[1];
                    $('#calendar')
                        .fullCalendar(
                            'renderEvent',
                            data,
                            true
                        );
                }
            }
        });
    }
</script>