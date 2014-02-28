<?php 
        //array com os cores css
    echo $this->Html->css(array('bootstrap.min', 'assets/jquery-ui/jquery-ui-1.10.1.custom.min', 'bootstrap-reset', 'assets/font-awesome/css/font-awesome', 'assets/jvector-map/jquery-jvectormap-1.2.2', 'clndr', 'nfchurch'));
        //clock css
    echo $this->Html->css('assets/css3clock/css/style');
        //Morris Chart CSS
    echo $this->Html->css('assets/morris-chart/morris');
        //custom styles for this template
    echo $this->Html->css(array('style', 'style-responsive'));


    echo $this->Html->script(array('lib/jquery', '../css/assets/jquery-ui/jquery-ui-1.10.1.custom.min', '../css/bs3/js/bootstrap.min', 'accordion-menu/jquery.dcjqaccordion.2.7', 'scrollTo/jquery.scrollTo.min', 'nicescroll/jquery.nicescroll', '../css/assets/jQuery-slimScroll-1.3.0/jquery.slimscroll', '../css/assets/skycons/skycons', '../css/assets/jquery.scrollTo/jquery.scrollTo', '../css/assets/calendar/clndr', '../css/assets/calendar/moment-2.2.1', 'calendar/evnt.calendar.init', '../css/assets/jvector-map/jquery-jvectormap-1.2.2.min', '../css/assets/jvector-map/jquery-jvectormap-us-lcc-en', '../css/assets/gauge/gauge', '../css/assets/css3clock/js/script', '../css/assets/easypiechart/jquery.easypiechart', '../css/assets/easypiechart/jquery.easypiechart', '../css/assets/sparkline/jquery.sparkline', '../css/assets/morris-chart/morris', '../css/assets/morris-chart/raphael-min', '../css/assets/flot-chart/jquery.flot', '../css/assets/flot-chart/jquery.flot.tooltip.min', '../css/assets/flot-chart/jquery.flot.resize', '../css/assets/flot-chart/jquery.flot.pie.resize', '../css/assets/flot-chart/jquery.flot.animator.min', '../css/assets/flot-chart/jquery.flot.growraf', 'dashboard', 'custom-select/jquery.customSelect.min', 'scripts', 'http://cdnjs.cloudflare.com/ajax/libs/jquery-easing/1.3/jquery.easing.min.js', 'http://cdnjs.cloudflare.com/ajax/libs/underscore.js/1.5.2/underscore-min.js'));
?>
<section id="main-content">
    <section class="wrapper">
        <?php echo $this->fetch('content'); ?>
    </section>
</section>
