<?php
class Ata extends SecretariaAppModel {
	public $hasMany = array('Secretaria.AtaArquivo');
}
