<?php
class Membro extends SecretariaAppModel {
	public $belongsTo = array('Secretaria.Estado', 'Secretaria.Profissao', 'Secretaria.Cargo', 'Secretaria.Escolaridade');
	public $hasMany = array('Secretaria.Relacionamento', 'Secretaria.Movimentacaoata');
}
