<?php
	class Relacionamento extends SecretariaAppModel{
		public $belongsTo = [
			'Membro' => [
				'foreignKey' => 'membro2_id',
				'fields' => ['id', 'nome'],
			]
		];
	}