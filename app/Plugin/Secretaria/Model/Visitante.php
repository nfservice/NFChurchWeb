<?php
	class Visitante extends SecretariaAppModel{
		public $useTable = 'membros';

		public $hasOne = array(
			'Endereco'
		);
	}