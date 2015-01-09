<?php
	App::uses('AppModel', 'Model');

	class Church extends AppModel {
		public $useTable = 'churchs';
		public $hasMany = array(
			'Permission',
		);
	}
?>