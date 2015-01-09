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

	public $all = false;

	public $hasMany = array(
		'Secretaria.Relacionamento', 
		'Secretaria.Movimentacaoata'
	);

	public function beforeFind($queryData){
		$queryData = parent::beforeFind($queryData);
		if (!$this->all) {
			$queryData['conditions']['Membro.tipo'] = 'Membro';
		}
		//retorna dados da pesquisa
		return $queryData;
	}
}
