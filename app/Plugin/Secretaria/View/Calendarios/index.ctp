<div class="row">
    <div class="col-sm-12 col-md-12">
        <section class="panel">
            <header class="panel-heading">
                Calendário
                <span class="tools pull-right">
                    <a href="javascript:modalLoad('<?php echo $this->Html->url(array('action' => 'add')); ?>');;" class="fa fa-plus"></a>
                    <a href="javascript:;" class="fa fa-cog"></a>
                    <a href="javascript:;" class="fa fa-times"></a>
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
            //alert('View: ' + view.name);
            modalLoad('<?php echo $this->Html->url(array('action' => 'edit')); ?>');
            // change the border color just for fun
        },
        events: [
            {
                id: '1',
                title:  'My Event',
                start:  '2014-10-31T14:30:00',
                allDay: false
            },
            {
                id: '2',
                title: 'Click for Google',
                start:  '2014-10-30T14:30:00',
                allDay: false
            }
        ],
        timeFormat: 'H(:mm)' // uppercase H for 24-hour clock
    });
</script>