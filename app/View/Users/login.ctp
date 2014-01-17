<!DOCTYPE html>
<html>
<head>
	<title>NFCHURCH</title>
	<?php echo $this->Html->css(array('bootstrap.min', 'nfchurch', 'login')); ?>
	<?php echo $this->Html->script(array('jquery.js', 'bootstrap.js', 'bootstrap-datepicker.js')); ?>
</head>
<body>
	<div class="login_box">
		<h1>Bem vindo ao sistema NFCHURCH</h1>
		<h5>"Aqui uma passagem da bíblia"</h5>
		<?php

		echo $this->Session->flash('auth');
		echo $this->Form->create('User', array('role' => 'form'));		

		echo $this->Form->input('username', array('label' => false, 'class' => 'col-md-8 form-control br', 'div' => false));

		echo $this->Form->input('password', array('label' => false, 'class' => 'col-md-8 form-control br', 'div' => false));

		//echo $this->Form->input('password', array('label' => 'Senha', 'class' => 'col-md-6 form-control'));
		echo $this->Form->end(__('Login', array('class' => 'btn btn-primary', 'type' => 'button')));

		?>
	</div>
</body>
</html>
