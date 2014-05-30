<?php 
App::uses('FB', 'Facebook.Lib');
class UsersController extends AppController {

	public function login()
	{
		$this->layout = 'login';
	    // If it is a post request we can assume this is a local login request
	    if ($this->request->isPost()){	    	
	        if ($this->Auth->login()){
	            $this->redirect($this->Auth->redirectUrl());
	        } else {
	            $this->Session->setFlash(__('Usuário/Senha inválidos.'));
	        }
	    } 
	}

	public function fblogin()
	{
		if (!empty($this->request->query['code'])) {
    		$code = $this->request->query['code'];
    		$ch = curl_init('https://graph.facebook.com/oauth/access_token?client_id=266658286843599&redirect_uri='.FULL_BASE_URL.$this->webroot.'users/fblogin&client_secret=970cebae1c0f9a6b7bfd15cc6912d12d&code='.$code);
    		curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    		$access_token = curl_exec($ch);
    		curl_close($ch);
    		parse_str($access_token, $output);

    		if (!empty($output['access_token'])) {
	    		$Facebook = new FB();
				$me = $Facebook->api('/me', array('access_token' => $output['access_token']));

				//Procura o id já cadastrado no sistema, se não achar, cadastra
				$user = $this->User->find('first', array(
					'conditions' => array(
						'facebook_id' => $me['id'],
					),
				));

				if (empty($user)) {
					$this->loadModel('Secretaria.Membro');

					$membro = $this->Membro->find('first', array(
						'conditions' => array(
							'Membro.email' => $me['email'],
						),
					));

					if (!empty($membro)) {
						$this->User->create();

						$salvar = array(
							'facebook_id' => $me['id'],
							'username' => $me['email'],
							'church_id' => $membro['Membro']['church_id'],
							'nome' => $me['name'],
						);

						$this->User->save($salvar);
						$user_id = $this->User->id;

						$this->Auth->login(array('id' => $this->User->id));

						$ch = curl_init();
					    curl_setopt($ch, CURLOPT_URL, 'https://graph.facebook.com/'.$me['id'].'/picture?width=336&height=336&redirect=false');
					    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
					    //curl_setopt($ch, CURLOPT_FOLLOWLOCATION, true);
					    $picture = json_decode(curl_exec($ch));
					    curl_close($ch);

					    $foto = file_get_contents($picture->data->url);

						file_put_contents(WWW_ROOT.'files/profile/'.$user_id.'.jpg', $foto);
						chmod(WWW_ROOT.'files/profile/'.$user_id.'.jpg', 0777);
					} else {
						$this->Session->setFlash('E-mail '.$me['email'].' não pertence à nenhuma igreja cadastrada.');
					}
				} else {
					$this->Auth->login($user['User']);

					$user_id = $user['User']['id'];
				}				
			} else {
				$this->Session->setFlash('Ocorreu um problema. Tente novamente.');
			}
    	} else {
    		$this->Session->setFlash('Ocorreu um problema. Tente novamente.');    		
    	}

    	$this->redirect($this->Auth->redirectUrl());
	}

	public function logout()
	{
	    if ($this->Auth->logout()){
	    	$this->redirect('/users/login');
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
    		if ($this->User->save($this->request->data))
    		{
    			//retorno Json
				//json_encode('Alterações Salvas Com Sucesso!');
				//$this->redirect(array('action' => 'index'));
			}
			else
			{
				//retorno Json
				//json_encode('Impossível Salvar Alterações');
				//$this->redirect(array('action' => 'index'));
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