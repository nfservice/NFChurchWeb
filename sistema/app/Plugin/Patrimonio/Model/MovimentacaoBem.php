<?php 
	class MovimentacaoBem extends PatrimonioAppModel{
		public $useTable = 'movimentacao_bens';

		public $belongsTo = array(
			'Bem' => array(
				'className' => 'Patrimonio.Bem',
			)
		);
	}