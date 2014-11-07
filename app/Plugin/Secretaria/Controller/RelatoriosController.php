<?php
	class RelatoriosController extends SecretariaAppController {
	
		public $uses = array();
		public function membros()
		{

			$this->layout = false;
			if ($this->request->is('post') || $this->request->is('put')) {
				
			} else {
				$this->render('membros');
			}
		}
	}