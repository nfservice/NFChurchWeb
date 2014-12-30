<?php
class Membro extends SecretariaAppModel {
	public $belongsTo = array(
		'Secretaria.Estado', 
		'Secretaria.Profissao', 
		'Secretaria.Cargo', 
		'Secretaria.Escolaridade'
	);

	public $hasOne = array(
		'Endereco'
	);

	public $hasMany = array(
		'Secretaria.Relacionamento', 
		'Secretaria.Movimentacaoata'
	);

	public function beforeFind($queryData){
		parent::beforeFind($queryData);
		$conditions['Membro.tipo'] = 'Membro';
		//retorna dados da pesquisa
		return $queryData;
	}
}
