<?php 

	class User extends AppModel{
		public $name = 'User';
	    public $validate = array(
	        'username' => array(
	            'required' => array(
	                'rule' => array('notEmpty'),
	                'message' => 'Entre com seu Usuário'
	            )
	        ),
	        'password' => array(
	            'required' => array(
	                'rule' => array('notEmpty'),
	                'message' => 'Entre com sua Senha.'
	            )
	        )
	    );
	}
	
?>