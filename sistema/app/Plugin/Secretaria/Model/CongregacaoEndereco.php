<?php
	class CongregacaoEndereco extends SecretariaAppModel {
		public $belongsTo = array(
			'Congregacao' => array(
				'className' => 'Secretaria.Congregacao'
			)
		);
	}