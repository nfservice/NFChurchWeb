<?php
	class VisitantesController extends SecretariaAppController{
		public function index(){
			$conditions = array();
			$conditions['Visitante.tipo ='] = 1;
			$this->set('visitantes', $this->paginate(null, $conditions));
			$this->layout ='';
		}
		public function add(){
			if ($this->request->is('post') || $this->request->is('put')) {
				
			} else {
				
			}
			$this->layout ='';
		}
		public function edit(){
			$this->layout ='';
		}
		public function view(){
			$this->layout ='';
		}
		public function delete(){
			$this->layout ='';
		}
	}