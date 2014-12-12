<?php 
	class Bem extends PatrimonioAppModel{
		public $useTable = 'bens';

		public $belongsTo = array(
			'TipoBem' => array(
				'className' => 'Patrimonio.TipoBem',
			),
			'Congregacao' => array(
				'className' => 'Secretaria.Congregacao',
			),
			'Membro' => array(
				'className' => 'Secretaria.Membro',
			),
			'Departamento' => array(
				'className' => 'Secretaria.Departamento',
			),
		);

		public $hasMany = array(
			'MovimentacaoBem' => array(
				'className' => 'Patrimonio.MovimentacaoBem',
				'dependent' => true,
				'foreignKey' => 'bem_id',
			),
		);
	}