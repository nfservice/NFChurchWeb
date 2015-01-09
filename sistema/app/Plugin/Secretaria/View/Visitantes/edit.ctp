<div class="col-lg-12">

	<?php echo $this->Form->create('Visitante', array('role' => 'form', 'class' => 'desable-form formModal')); 

	// cadeado para desbloquear o form
   	echo $this->element('desbloquearForm');

	echo $this->Form->input('nome', array('label' => 'Nome:', 'class' => 'form-control', 'div' => array('class' => 'form-group col-md-9')));
	echo $this->Form->input('sexo', array('label' => 'Sexo:', 'options' => array('0' => 'Selecione', '1' => 'Masculino', '2' => 'Feminino'), 'class' => 'form-control', 'div' => array('class' => 'form-group col-md-3')));
	echo $this->Form->input('datanascimento', array('label' => 'Data de Nascimento:', 'type' => 'text', 'class' => 'form-control', 'div' => array('class' => 'form-group col-md-4')));
	echo $this->Form->input('email', array('label' => 'E-mail:', 'type' => 'email', 'class' => 'form-control', 'div' => array('class' => 'form-group col-md-4')));
	echo $this->Form->input('fone', array('label' => 'Telefone:', 'type' => 'text', 'class' => 'form-control', 'div' => array('class' => 'form-group col-md-4')));
	echo $this->Form->input('cel', array('label' => 'Celular:', 'type' => 'text', 'class' => 'form-control', 'div' => array('class' => 'form-group col-md-4')));
	echo $this->Form->input('estadocivil', array('label' => 'Estado Civil:', 'options' => array('0' => 'Solteiro', '1' => 'Casado', '2' => 'Viuvo', '3' => 'Desquitado'), 'class' => 'form-control', 'class' => 'form-control', 'div' => array('class' => 'form-group col-md-3')));
	//declarando inputs hidden
	echo $this->Form->input('id', array('type' => 'hidden', 'value' => $this->request->data['Visitante']['id'], 'class' => 'form-control'));
	echo $this->Form->input('tipo', array('type' => 'hidden', 'value' => '2'));
	echo $this->Form->input('Endereco.id', array('type' => 'hidden', 'value' => $this->request->data['Endereco']['id'], 'class' => 'form-control'));
	//fim hidden
	echo $this->Form->input('Endereco.cep', array('type' => 'text', 'label' => 'Cep:', 'class' => 'form-control', 'type' => 'text', 'class' => 'form-control', 'div' => array('class' => 'form-group col-md-5')));
	echo $this->Form->input('Endereco.logradouro', array('type' => 'text', 'label' => 'Logradouro', 'class' => 'form-control', 'type' => 'text', 'class' => 'form-control', 'div' => array('class' => 'form-group col-md-10')));
	echo $this->Form->input('Endereco.numero', array('type' => 'text', 'label' => 'Número', 'class' => 'form-control', 'type' => 'text', 'class' => 'form-control', 'div' => array('class' => 'form-group col-md-2')));
	echo $this->Form->input('Endereco.bairro', array('type' => 'text', 'label' => 'Bairro', 'class' => 'form-control', 'type' => 'text', 'class' => 'form-control', 'div' => array('class' => 'form-group col-md-8')));
	echo $this->Form->input('Endereco.complemento', array('type' => 'text', 'label' => 'Complemento:', 'class' => 'form-control', 'type' => 'text', 'class' => 'form-control', 'div' => array('class' => 'form-group col-md-4')));
	echo $this->Form->input('Endereco.cidade', array('type' => 'text', 'label' => 'Cidade', 'class' => 'form-control', 'type' => 'text', 'class' => 'form-control', 'div' => array('class' => 'form-group col-md-6')));
	echo $this->Form->input('Endereco.estado_id', array('label' => 'Estado', 'options' => $estados, 'class' => 'form-control', 'class' => 'form-control', 'div' => array('class' => 'form-group col-md-6')));

    // modal com confirmação de alteração de cadastro
    echo $this->element('modal/controleForm');

    // botoões do formulário
    echo $this->element('botoesForm');

    echo $this->Form->end(); 
    ?>

</div>
