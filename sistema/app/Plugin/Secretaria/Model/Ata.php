<?php
class Ata extends SecretariaAppModel {
	public $hasMany = array(
		'AtaArquivo' => array(
			'className' => 'Secretaria.AtaArquivo',
			'dependent' => true,
		),
		'Movimentacaoata' => array(
			'className' => 'Secretaria.Movimentacaoata',
			'dependent' => true,
		),
	);
}
