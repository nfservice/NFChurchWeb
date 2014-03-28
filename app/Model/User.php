<?php
	App::uses('AppModel', 'Model');

	class User extends AppModel {
		public function beforeSave($options = array()) {
		parent::beforeSave();
	    if (isset($this->data[$this->alias]['password'])) {
	        $this->data[$this->alias]['password'] = AuthComponent::password($this->data[$this->alias]['password']);
	    }
	    return true;
	}
	}
?>