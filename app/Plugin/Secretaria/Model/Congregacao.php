<?php
	class Congregacao extends SecretariaAppModel {
		public $hasMany = array(
			'Contato' => array(
				'className' => 'Secretaria.Contato',
			),
			'CongregacaoEndereco' => array(
				'className' => 'Secretaria.CongregacaoEndereco'
			)
		);
	}