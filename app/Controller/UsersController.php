<?php 
	class UsersController extends AppController {
		public function beforeFilter(){
			parent::beforeFilter();
			$this->Auth->allow('login', 'logout');
		}

		public function login(){
			$this->layout = '';
		}
	}
 ?>