<div class="users form">
<?php echo $this->Session->flash('auth'); ?>
<?php echo $this->Form->create('User');?>
<?php 
	echo $this->Html->css(array('bootstrap.min', 'nfchurch', 'datepicker'));
    echo $this->Html->script(array('jquery.js', 'bootstrap.js', 'bootstrap-datepicker.js'));
?>
    <fieldset class="col-md-7">
        <legend><?php echo __(''); ?></legend>
        <?php echo $this->Form->input('username', array('label' => 'Email', 'class' => 'col-md-6 form-control'));
        echo $this->Form->input('password', array('label' => 'Senha', 'class' => 'col-md-6 form-control'));
        echo $this->Form->end(__('Login', array('style' => 'margin-top:10px')));
    ?>
    </fieldset>

</div>