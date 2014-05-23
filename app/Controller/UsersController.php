<?php 
	class UsersController extends AppController {
		public function login()
		{
			$this->layout = 'login';
		    // If it is a post request we can assume this is a local login request
		    if ($this->request->isPost()){
		        if ($this->Auth->login()){
		            $this->redirect($this->Auth->redirectUrl());
		        } else {
		            $this->Session->setFlash(__('Invalid Username or password. Try again.'));
		        }
		    } 

		    // When facebook login is used, facebook always returns $_GET['code'].
		    elseif($this->request->query('code')){
		    	
		        // User login successful
		        
		        
		        $fb_user = $this->Facebook->getUser();          # Returns facebook user_id
		        var_dump($fb_user);
		        die();

		        if ($fb_user){

		            $fb_user = $this->Facebook->api('/me');     # Returns user information

		            // We will varify if a local user exists first
		            $local_user = $this->User->find('first', array(
		                'conditions' => array('username' => $fb_user['email'])
		            ));

		            // If exists, we will log them in
		            if ($local_user){
		                $this->Auth->login($local_user['User']);            # Manual Login
		                $this->redirect($this->Auth->redirectUrl());
		            } 

		            // Otherwise we ll add a new user (Registration)
		            else {
		                $data['User'] = array(
		                    'username'      => $fb_user['email'],                               # Normally Unique
		                    'password'      => AuthComponent::password(uniqid(md5(mt_rand()))), # Set random password
		                    'role'          => 'author'
		                );

		                // You should change this part to include data validation
		                $this->User->save($data, array('validate' => false));

		                // After registration we will redirect them back here so they will be logged in
		                $this->redirect(Router::url('/users/login?code=true', true));
		            }
		        }

		        else {
		            // User login failed..
		        }
		    }
		}

	    public function index()
	    {
	    	$this->layout = false;
	    	//verifica se foi feito algum filtro	    	
	    	if (!empty($this->request->data['filtro']))
	    	{
	    		//condições para pesquisa
	    		//campos para não entrar na pesquisa
	    		$excludes = array('id', 'password', 'created', 'modified', 'uid', 'church_id');
	    		//pega campos da model
	    		$fields = $this->User->schema();
	    		foreach ($fields as $key => $value) {
	    			if (!in_array($key, $excludes)) {
	    				$conditions['OR']['User.'.$key.' LIKE '] = '%'.$this->request->data['filtro'].'%';
	    			}
	    		}
	    	}
	    	else
	    	{
	    		$conditions = array();
	    	}
	    	//busca todos os regsitros desta igreja
	    	$users = $this->User->find('all', array('conditions' => $conditions));
	    	//seta registros para a view
	    	$this->set('users', $users);
	    }


	    public function add()
	    {
	    	$this->layout = false;
	    	if ($this->request->is('post') || $this->request->is('put'))
	    	{
	    		//requisições Put e Post, Cria novo registro e tenta salvar
	    		$this->User->create();
	    		if ($this->User->saveAll($this->request->data))
	    		{
	    			//Retorno json
	    			json_encode('Usuário Cadastrado com sucesso!');
	    		}
	    		else
	    		{
	    			//Retorno json
	    			json_encode('Usuário Não Cadastrado!');
	    		}
	    	}
	    }

	    public function edit($id = null)
	    {
	    	$this->layout = false;

	    	if (!empty($id))
	    	{
	    		//Se $id não estiver vazio, seta id da Model com $id e então verifica se o registro existe
	    		$this->User->id = $id;
		    	if (!$this->User->exists())
		    	{
		    		//retorno Json
		    		json_encode('Usuário Ínexistente!');
		    	}
	    	}
	    	if ($this->request->is('post') || $this->request->is('put'))
	    	{
	    		//Requisição Put ou Post tenta salvar alterações no registro
	    		if ($this->User->saveAll($this->request->data))
	    		{
	    			//retorno Json
					json_encode('Alterações Salvas Com Sucesso!');
					$this->redirect(array('action' => 'index'));
				}
				else
				{
					//retorno Json
					json_encode('Impossível Salvar Alterações');
					$this->redirect(array('action' => 'index'));
				}
	    	}
	    	else
	    	{
	    		//requisições diferente de Put e Post retorna array com informações do registro $id
	    		$this->request->data = $this->User->read(array('id', 'nome', 'username', 'telefone', 'celular', 'cpf'), $id);
	    	}
	    }

	    public function delete($id = null)
	    {
	    	$this->layout = false;
	    	$this->autoRender = false;
	    	//verificando metodo de requisição
			if (!$this->request->is('post'))
			{
				json_encode('Metono Não Permitido');
			}
			//verificando se este $id existe
			$this->User->id = $id;
			if (!$this->User->exists())
			{
				json_encode('Usuário Inexistente!');
			}
			//excluindo usuário
			if ($this->User->delete())
			{
				json_encode('Usuário Deletado');
			}
			else
			{
				json_encode('O Usuário não pôde ser deletado');
			}
		}
	}