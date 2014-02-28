<div class="col-lg-12">
	<ul class="breadcrumb">
		<li><a href="#"><i class="fa fa-home"></i> Home</a></li>
		<li><a href="#">Secretaria</a></li>
		<li><a href="#">Visitantes</a></li>
		<li class="active">Adicionar Visitante</li>
	</ul>
	<div class="row">
		<div class="col-md-12">
			<section class="panel">
				<header class="panel-heading">
					Adicionar novo visitante
				</header>
				<div class="panel-body">
					<?php 
					echo $this->Form->create(array('Visitante', 'role' => 'form'));
					echo $this->Form->input('nome', array('label' => 'Nome:', 'class' => 'form-control', 'div' => array('class' => 'form-group col-md-6')));
					echo $this->Form->input('sexo', array('label' => 'Sexo:', 'options' => array('0' => 'Selecione', '1' => 'Masculino', '2' => 'Feminino'), 'class' => 'form-control', 'div' => array('class' => 'form-group col-md-3')));
					echo $this->Form->input('datanascimento', array('label' => 'Data de Nascimento:', 'type' => 'text', 'class' => 'form-control', 'div' => array('class' => 'form-group col-md-3')));
					echo $this->Form->input('email', array('label' => 'E-mail:', 'class' => 'form-control', 'div' => array('class' => 'form-group col-md-6')));
					echo $this->Form->input('fone', array('label' => 'Telefone:', 'class' => 'form-control', 'div' => array('class' => 'form-group col-md-3')));
					echo $this->Form->input('cel', array('label' => 'Celular:', 'class' => 'form-control', 'div' => array('class' => 'form-group col-md-3')));
					echo $this->Form->input('estadocivil', array('label' => 'Estado Civil:', 'options' => array('0' => 'Solteiro', '1' => 'Casado', '2' => 'Viuvo', '3' => 'Desquitado'), 'class' => 'form-control', 'div' => array('class' => 'form-group col-md-3')));
					//declarando inputs hidden
					echo $this->Form->input('tipo', array('type' => 'hidden', 'value' => '2'));
					//fim hidden
					echo $this->Form->input('Endereco.cep', array('type' => 'text', 'label' => 'Cep:', 'class' => 'form-control', 'div' => array('class' => 'form-group col-md-2')));
					echo $this->Form->input('Endereco.logradouro', array('type' => 'text', 'label' => 'Logradouro', 'class' => 'form-control', 'div' => array('class' => 'form-group col-md-6')));
					echo $this->Form->input('Endereco.numero', array('type' => 'text', 'label' => 'Número', 'class' => 'form-control', 'div' => array('class' => 'form-group col-md-1')));
					echo $this->Form->input('Endereco.bairro', array('type' => 'text', 'label' => 'Bairro', 'class' => 'form-control', 'div' => array('class' => 'form-group col-md-3')));
					echo $this->Form->input('Endereco.complemento', array('type' => 'text', 'label' => 'Complemento:', 'class' => 'form-control', 'div' => array('class' => 'form-group col-md-2')));
					echo $this->Form->input('Endereco.cidade', array('type' => 'text', 'label' => 'Cidade', 'class' => 'form-control', 'div' => array('class' => 'form-group col-md-3')));
					echo $this->Form->input('Endereco.estado_id', array('label' => 'Estado', 'options' => $estados, 'class' => 'form-control', 'div' => array('class' => 'form-group col-md-4')));
					echo $this->Form->input($this->Html->link('Voltar', array('plugin' => 'secretaria', 'controller' => 'visitantes', 'action' => 'index')), array('type' => 'button', 'label' => false, 'class' => 'btn btn-cancel', 'div' => array('class' => 'form-group col-md-1')));
					echo $this->Form->input('Salvar Visitante', array('type' => 'submit', 'label' => false, 'class' => 'btn btn-success', 'div' => array('class' => 'form-group col-md-4')));
					echo $this->Form->end();
					?>
				</div>
			</section>
		</div>
	</div>
</div>