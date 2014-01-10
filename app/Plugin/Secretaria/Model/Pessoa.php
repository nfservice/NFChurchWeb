<?php
class Pessoa extends SecretariaAppModel {
	public $belongsTo = array('Secretaria.Estado', 'Secretaria.Profissao');
}
