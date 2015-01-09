<?php 
	class MovimentacaoItem extends BibliotecaAppModel{
		public $useTable = 'movimentacao_itens';

		public $belongsTo = array(
			'Membro' => array(
				'className' => 'Secretaria.Membro',
			),
			'Item' => array(
				'className' => 'Secretaria.Item',
			),
		);
	}