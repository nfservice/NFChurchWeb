<div class="col-md-12">
	<div class="row">
		<?php
			echo $this->Form->create('MovimentacaoBem', array('role' => 'form', 'class' => 'formModal'));
				echo '<div class="col-md-12"><h3> Movimentação - '.$this->request->data['Bem']['nome'].'</h3></div>';

				$options = array('2' => 'Saída', '1' => 'Entrada');
				echo $this->Form->input('user_id', array('type' => 'hidden', 'value' => $this->Session->read('Auth.User.id')));
				echo $this->Form->input('bem_id', array('type' => 'hidden', 'value' => $this->request->data['Bem']['id']));
				echo $this->Form->input('tipo', array('label' => 'Tipo:', 'options' => $options, 'class' => 'form-control', 'div' => array('class' => 'form-group col-md-2')));

				echo $this->Form->input('quantidade', array('label' => 'Quantidade:', 'value' => '1', 'min' => 1, 'max' => $this->request->data['Bem']['quantidade'], 'type' => 'number', 'class' => 'form-control', 'div' => array('class' => 'form-group col-md-2')));

				echo $this->Form->input('motivo', array('label' => 'Motivo:', 'class' => 'form-control', 'div' => array('class' => 'form-group col-md-8')));
		?>
				<div class="form-group col-md-2">
					<button data-dismiss="modal" class="btn btn-default form-control" type="button">Cancelar</button>
				</div>
		<?php
				
				echo $this->Form->input('Salvar Movimentação', array('type' => 'submit', 'label' => false, 'class' => 'btn btn-success form-control', 'div' => array('class' => 'form-group col-md-4')));
			echo $this->Form->end();
		?>
	</div>

	<h3>Histórico de Movimentações</h3>

	<table class="table table-bordered">
		<tr>
			<th>Tipo</th>
			<th>Motivo</th>
			<th>Quantidade</th>
			<th>Saldo</th>
		</tr>
		<?php
			foreach ($this->request->data['MovimentacaoBem'] as $key => $value) {
				if ($value['tipo'] == '1') {
					$value['tipo'] = 'Entrada';
				} else {
					$value['tipo'] = 'Saída';
				}

				echo '<tr><td>'.$value['tipo'].'</td><td>'.$value['motivo'].'</td><td>'.$value['quantidade'].'</td><td>'.$value['saldo'].'</td>';
			}
		?>
	</table>
</div>