<?php 
	class Item extends BibliotecaAppModel{
		public $useTable = 'itens';

		public $belongsTo = array(
			'Autor' => array(
				'className' => 'Biblioteca.Autor',
			),
			'Categoria' => array(
				'className' => 'Biblioteca.Categoria',
			),
			'Editora' => array(
				'className' => 'Biblioteca.Editora',
			),
			'Tipo' => array(
				'className' => 'Biblioteca.Tipo',
			)
		);

		public $hasMany = array(
			'MovimentacaoItem' => array(
				'foreignKey' => 'item_id',
				'className' => 'Biblioteca.MovimentacaoItem'
			)
		);
	}