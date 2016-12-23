<?php 
App::import('Vendor', 'facebook', array('file' => 'Facebook/autoload.php'));

use Facebook\FacebookSession;
use Facebook\FacebookRequest;
use Facebook\GraphUser;
use Facebook\FacebookRequestException;

App::uses('AppController', 'Controller');

class UsersController extends AppController {

	public function beforeFilter() 
	{
		parent::beforeFilter();
		$this->Auth->allow(array('login', 'logout', 'teste', 'fblogin', 'addUser'));
	}

	public function cascade($plugin, $controller, $action) {

		$this->autoRender = false;
		$this->loadModel('Cascade');

		$cascades = $this->Cascade->find('all', 
			array(
				'conditions' => array(
					'plugin_de' => $plugin,
					'controller_de' => $controller,
					'OR' => array(
						array(
							'action_de LIKE' => '%'.$action.'%',
						),
						array(
							'action_de' => '*',
						)
					)
				),
			)
		);
		return $cascades;
	}

	public function login()
	{
		$this->layout = 'login';
		// If it is a post request we can assume this is a local login request
		if ($this->request->isPost()){			
			if ($this->Auth->login()){
				$this->Session->write('choosed', $this->Session->read('Auth.User.church_id'));
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
				/*$Facebook = new FB();
				$me = $Facebook->api('/me', array('access_token' => $output['access_token']));

				var_dump($output['access_token']);
				var_dump($me);
				die();*/

				FacebookSession::setDefaultApplication('266658286843599','970cebae1c0f9a6b7bfd15cc6912d12d');

				// Use one of the helper classes to get a FacebookSession object.
				//   FacebookRedirectLoginHelper
				//   FacebookCanvasLoginHelper
				//   FacebookJavaScriptLoginHelper
				// or create a FacebookSession with a valid access token:
				$session = new FacebookSession($output['access_token']);

				// Get the GraphUser object for the current user:

				try {
					$me = (new FacebookRequest($session, 'GET', '/me'))->execute()->getGraphObject(GraphUser::className());

					//Procura o id já cadastrado no sistema, se não achar, cadastra
					$user = $this->User->find('first', array(
						'conditions' => array(
							'facebook_id' => $me->getProperty('id'),
						),
					));

					if (empty($user)) {
						$this->loadModel('Secretaria.Membro');

						$membro = $this->Membro->find('first', array(
							'conditions' => array(
								'Membro.email' => $me->getProperty('email'),
							),
						));

						if (!empty($membro)) {
							$this->User->create();

							$salvar = array(
								'facebook_id' => $me->getProperty('id'),
								'username' => $me->getProperty('email'),
								'church_id' => $membro['Membro']['church_id'],
								'nome' => $me->getProperty('name'),
							);

							$this->User->save($salvar);
							$user_id = $this->User->id;

							$this->loadModel('PermissaoPadrao');
							$permissaoPadrao = $this->PermissaoPadrao->find('all', array('conditions' => array('PermissaoPadrao.church_id' => $membro['Membro']['church_id'])));
							$permission = array();
							foreach ($permissaoPadrao as $key => $value) {
								$permission['Permission'][$key]['user_id'] = $user_id;
								$permission['Permission'][$key]['plugin'] = $permissaoPadrao[$key]['PermissaoPadrao']['plugin'];
								$permission['Permission'][$key]['controller'] = $permissaoPadrao[$key]['PermissaoPadrao']['controller'];
								$permission['Permission'][$key]['action'] = $permissaoPadrao[$key]['PermissaoPadrao']['action'];
								$permission['Permission'][$key]['allowed'] = $permissaoPadrao[$key]['PermissaoPadrao']['allowed'];
							}
							$this->User->Permission->create();
							$this->User->Permission->saveAll($permission['Permission']);

							$this->Auth->login(array('id' => $this->User->id));

							$ch = curl_init();
							curl_setopt($ch, CURLOPT_URL, 'https://graph.facebook.com/'.$me->getProperty('id').'/picture?width=336&height=336&redirect=false');
							curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

							//curl_setopt($ch, CURLOPT_FOLLOWLOCATION, true);
							$picture = json_decode(curl_exec($ch));
							curl_close($ch);

							$foto = file_get_contents($picture->data->url);

							file_put_contents(WWW_ROOT.'files/profile/'.$user_id.'.jpg', $foto);
							chmod(WWW_ROOT.'files/profile/'.$user_id.'.jpg', 0777);
						} else {
							$this->Session->setFlash('E-mail '.$me->getProperty('email').' não pertence à nenhuma igreja cadastrada.');
						}
					} else {
						$this->Auth->login($user['User']);

						$user_id = $user['User']['id'];
					}

				} catch (FacebookRequestException $e) {
					var_dump($e);
				} catch (Exception $e) {
					var_dump($e);
				}
								
			} else {
				$this->Session->setFlash('Ocorreu um problema no token de acesso. Tente novamente.');
			}
		} else {
			$this->Session->setFlash('Ocorreu um problema na query. Tente novamente.');			
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
		$conditions = ['User.church_id' => $this->Session->read('choosed')];
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
		//busca todos os regsitros desta igreja
		$users = $this->User->find('all', array('conditions' => $conditions));
		//seta registros para a view
		$this->set('users', $users);
	}


	public function add()
	{
		if ($this->request->is('post') || $this->request->is('put'))
		{
			//requisições Put e Post, Cria novo registro e tenta salvar
			$this->User->create();
			$existe = array();
			$corretas = array();
			foreach ($this->request->data['Permission'] as $key => $permission) {
				if ($permission['allowed'] == '1') {
					if (empty($existe[$permission['plugin'].'-'.$permission['controller'].'-'.$permission['action']])) {
						$existe[$permission['plugin'].'-'.$permission['controller'].'-'.$permission['action']] = '1';
						$cascades = $this->cascade($permission['plugin'], $permission['controller'], $permission['action']);
						foreach ($cascades as $key => $cascade) {
							if (empty($existe[$cascade['Cascade']['plugin_para'].'-'.$cascade['Cascade']['controller_para'].'-'.$cascade['Cascade']['action_para']])) {
								$existe[$cascade['Cascade']['plugin_para'].'-'.$cascade['Cascade']['controller_para'].'-'.$cascade['Cascade']['action_para']] = '1';
								$corretas[] = array(
									'plugin' => $cascade['Cascade']['plugin_para'],
									'controller' => $cascade['Cascade']['controller_para'],
									'action' => $cascade['Cascade']['action_para'],
									'allowed' => '1',
								);
							}
						}
					}
				} else {
					unset($this->request->data['Permission'][$key]);
				}
			}
			$this->request->data['Permission'] = array_merge($this->request->data['Permission'], $corretas);
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
		} else {
			$regex = '/(?<=\tpublic\sfunction\s).{1,50}(?=\()|(?<=\tpublic\sfunction\s).{1,50}(?=\s\()|(?<=\s\s\s\spublic\sfunction\s).{1,50}(?=\()|(?<=\s\s\s\spublic\sfunction\s).{1,50}(?=\s\()|(?<=\spublic\sfunction\s).{1,50}(?=\()|(?<=\spublic\sfunction\s).{1,50}(?=\s\()/';

			/*----- PEGA ACTIONS DE PLUGINS - CONTROLLER E CONTROLLERS ------- */
			//Pega caminho dos Plugins dentro do Projeto
			$path = APP.'Plugin/';
			$plugins = glob($path.'*') or die("Erro ao acessar " . $path);
			$completa = array();
			foreach ($plugins as $key => $value) {
				//Separa o caminho pela chave '/' e inverte a array para que o primeiro valor do array seja o nome do Plugin
				$inverte = explode('/', $value);
				$invertida = array_reverse($inverte);
				//Pega todos os Controllers do Plugin selecionado
				$controllers = App::objects($invertida[0].'.Controller');

				if ($invertida[0] != 'Contador') {
					foreach ($controllers as $chave => $valor) {
						/*A variável $controllers recebe um valor identico a "UsersController"
							Porém vamos precisar usar o App::import e para isso é preciso separar o "UsersController" em "User" "Controller"		
						*/
						//$pass1 = preg_replace("/([a-z])([A-Z])/","\\1 \\2",$controllers[$chave]);
						//$pass2 = preg_replace("/([A-Z])([A-Z][a-z])/","\\1 \\2",$pass1);
						$controller = explode('Controller', $controllers[$chave]);
						
						if (is_file($path.$invertida[0].'/Controller/'.$controller[0].'Controller.php') && strpos($controller[0], 'App') === false){
							//Ok, aqui importamos a Controller e todas as actions.
							$file = file_get_contents($path.$invertida[0].'/Controller/'.$controller[0].'Controller.php');
							preg_match_all($regex, $file, $actions);

							$actions = $actions[0];

							$actions = array_diff($actions, get_class_methods('AppController'));
							foreach ($actions as $action) {
								if (empty($completa[$invertida[0]][$controller[0]])) {
									$completa[$invertida[0]][$controller[0]] = array();
								}
								//$completa[] = array('Plugin' => $invertida[0], 'Controller' => $controller[0], 'Action' => $action);
								//if ($action == 'index' || $action == 'cadastrar' || $action == 'editar' || $action == 'visualizar' || $action == 'deletar'){
								if (!in_array($action, $completa[$invertida[0]][$controller[0]])) {
									$completa[$invertida[0]][$controller[0]][] = $action;
								}
							}
							
						}
					}
				}
			}


			$path1 = APP.'Controller/';
			$controll = glob($path1.'*') or die("Erro ao acessar " . $path1);

			foreach ($controll as $key1 => $value1) {
				$inverte1 = explode('/', $value1);
				$invertida1 = array_reverse($inverte1);
				$semPhp = explode('.', $invertida1[0]);
				
				//$pass1 = preg_replace("/([a-z])([A-Z])/","\\1 \\2",$semPhp[0]);
				//$pass2 = preg_replace("/([A-Z])([A-Z][a-z])/","\\1 \\2",$pass1);
				//$controller1 = explode(' ', $pass2);

				$controller1 = explode('Controller', $semPhp[0]);
		
				if (is_file($path1.$invertida1[0]) && $controller1[0] != 'App' ) {		   
					$file = file_get_contents($path1.$invertida1[0]);
					preg_match_all($regex, $file, $actions1);

					$actions1 = $actions1[0];

					$actions1 = array_diff($actions1, get_class_methods('AppController'));
					foreach ($actions1 as $action1) {
						if (empty($completa[''][$controller1[0]])) {
							$completa[''][$controller1[0]] = array();
						}
						//$completa[] = array('Plugin' => '', 'Controller' => $controller1[0], 'Action' => $action1);
						//if ($action1 == 'index' || $action1 == 'cadastrar' || $action1 == 'editar' || $action1 == 'visualizar' || $action1 == 'deletar'){
						if (!in_array($action1, $completa[''][$controller1[0]])) {
							$completa[''][$controller1[0]][] = $action1;
						}
					}
				}
			}
			/*----- FIM PEGA ACTIONS DE PLUGINS - CONTROLLER E CONTROLLERS ------- */

			$salvar = array();
			foreach ($completa as $plugin => $value) {
				foreach ($value as $controller => $value2) {
					foreach ($value2 as $value3 => $action) {
						$salvar[] = array(
							'plugin' => $plugin,
							'controller' => $controller,
							'action' => $action,
						);
					}
				}
			}

			$permissao = $completa;
			$this->set('permissao', $permissao);
		}
	}

	public function addUser()
	{
		$this->loadModel('Church');

		$this->Church->create();
		$this->Church->save($this->request->data);
		$salvar = array(
			'User' => array(
				'tipo' => '1',
				'username' => $this->request->data['User']['username'],
				'nome' => $this->request->data['User']['nome'],
				'password' => $this->request->data['User']['password'],
				'church_id' => $this->Church->id,
				'telefone' => $this->request->data['User']['telefone'],
			),
		);

		$regex = '/(?<=\tpublic\sfunction\s).{1,50}(?=\()|(?<=\tpublic\sfunction\s).{1,50}(?=\s\()|(?<=\s\s\s\spublic\sfunction\s).{1,50}(?=\()|(?<=\s\s\s\spublic\sfunction\s).{1,50}(?=\s\()|(?<=\spublic\sfunction\s).{1,50}(?=\()|(?<=\spublic\sfunction\s).{1,50}(?=\s\()/';		

		/*----- PEGA ACTIONS DE PLUGINS - CONTROLLER E CONTROLLERS ------- */
        //Pega caminho dos Plugins dentro do Projeto
        $path = APP.'Plugin/';
        $plugins = glob($path.'*') or die("Erro ao acessar " . $path);
        $completa = array();

        foreach ($plugins as $key => $value) {
            //Separa o caminho pela chave '/' e inverte a array para que o primeiro valor do array seja o nome do Plugin
            $inverte = explode('/', $value);
            $invertida = array_reverse($inverte);
            //Pega todos os Controllers do Plugin selecionado
            $controllers = App::objects($invertida[0].'.Controller');

            if ($invertida[0] != 'Contador') {
                foreach ($controllers as $chave => $valor) {
                    /*A variável $controllers recebe um valor identico a "UsersController"
                        Porém vamos precisar usar o App::import e para isso é preciso separar o "UsersController" em "User" "Controller"        
                    */
                    //$pass1 = preg_replace("/([a-z])([A-Z])/","\\1 \\2",$controllers[$chave]);
                    //$pass2 = preg_replace("/([A-Z])([A-Z][a-z])/","\\1 \\2",$pass1);
                    $controller = explode('Controller', $controllers[$chave]);
                    
                    if (is_file($path.$invertida[0].'/Controller/'.$controller[0].'Controller.php') && strpos($controller[0], 'App') === false){
                        //Ok, aqui importamos a Controller e todas as actions.
                        $file = file_get_contents($path.$invertida[0].'/Controller/'.$controller[0].'Controller.php');
                        preg_match_all($regex, $file, $actions);

                        $actions = $actions[0];

                        $actions = array_diff($actions, get_class_methods('AppController'));
                        foreach ($actions as $action) {
                            if (empty($completa[$invertida[0]][$controller[0]])) {
                                $completa[$invertida[0]][$controller[0]] = array();
                            }
                            //$completa[] = array('Plugin' => $invertida[0], 'Controller' => $controller[0], 'Action' => $action);
                            //if ($action == 'index' || $action == 'cadastrar' || $action == 'editar' || $action == 'visualizar' || $action == 'deletar'){
                            if (!in_array($action, $completa[$invertida[0]][$controller[0]])) {
                                $completa[$invertida[0]][$controller[0]][] = $action;
                            }
                        }
                        
                    }
                }
            }
        }


        $path1 = APP.'Controller/';
        $controll = glob($path1.'*') or die("Erro ao acessar " . $path1);

        foreach ($controll as $key1 => $value1) {
            $inverte1 = explode('/', $value1);
            $invertida1 = array_reverse($inverte1);
            $semPhp = explode('.', $invertida1[0]);
            
            //$pass1 = preg_replace("/([a-z])([A-Z])/","\\1 \\2",$semPhp[0]);
            //$pass2 = preg_replace("/([A-Z])([A-Z][a-z])/","\\1 \\2",$pass1);
            //$controller1 = explode(' ', $pass2);

            $controller1 = explode('Controller', $semPhp[0]);
    
            if (is_file($path1.$invertida1[0]) && $controller1[0] != 'App' ) {           
            	$file = file_get_contents($path1.$invertida1[0]);
                preg_match_all($regex, $file, $actions1);

                $actions1 = $actions1[0];

                $actions1 = array_diff($actions1, get_class_methods('AppController'));
                foreach ($actions1 as $action1) {
                    if (empty($completa[''][$controller1[0]])) {
                        $completa[''][$controller1[0]] = array();
                    }
                    //$completa[] = array('Plugin' => '', 'Controller' => $controller1[0], 'Action' => $action1);
                    //if ($action1 == 'index' || $action1 == 'cadastrar' || $action1 == 'editar' || $action1 == 'visualizar' || $action1 == 'deletar'){
                    if (!in_array($action1, $completa[''][$controller1[0]])) {
                        $completa[''][$controller1[0]][] = $action1;
                    }
                }
            }
        }
        /*----- FIM PEGA ACTIONS DE PLUGINS - CONTROLLER E CONTROLLERS ------- */

        foreach ($completa as $plugin => $value) {
        	foreach ($value as $controller => $value2) {
        		foreach ($value2 as $value3 => $action) {
	        		$salvar['Permission'][] = array(
	        			'plugin' => $plugin,
	        			'controller' => $controller,
	        			'action' => $action,
	        			'allowed' => 1
	        		);
	        	}
        	}
        }		

        $this->User->create();
		$this->User->saveAll($salvar);
		$user = $this->User->read(null, $this->User->id);
		$this->Auth->login($user['User']);
		$this->Session->write('choosed', $this->Church->id);

		$this->redirect('/pages/home');
	}

	public function edit($id = null)
	{

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
			if(empty($this->request->data['User']['password'])){
				unset($this->request->data['User']['password']);
			}
			$this->User->Permission->deleteAll(array('user_id' => $id), false);
			$existe = array();
			$corretas = array();
			foreach ($this->request->data['Permission'] as $key => $permission) {
				if ($permission['allowed'] == '1') {
					if (empty($existe[$permission['plugin'].'-'.$permission['controller'].'-'.$permission['action']])) {
						$existe[$permission['plugin'].'-'.$permission['controller'].'-'.$permission['action']] = '1';
						$cascades = $this->cascade($permission['plugin'], $permission['controller'], $permission['action']);
						foreach ($cascades as $key => $cascade) {
							if (empty($existe[$cascade['Cascade']['plugin_para'].'-'.$cascade['Cascade']['controller_para'].'-'.$cascade['Cascade']['action_para']])) {
								$existe[$cascade['Cascade']['plugin_para'].'-'.$cascade['Cascade']['controller_para'].'-'.$cascade['Cascade']['action_para']] = '1';
								$corretas[] = array(
									'plugin' => $cascade['Cascade']['plugin_para'],
									'controller' => $cascade['Cascade']['controller_para'],
									'action' => $cascade['Cascade']['action_para'],
									'allowed' => '1',
								);
							}
						}
					}
				} else {
					unset($this->request->data['Permission'][$key]);
				}
			}
			$this->request->data['Permission'] = array_merge($this->request->data['Permission'], $corretas);
			//Requisição Put ou Post tenta salvar alterações no registro
			if ($this->User->saveAll($this->request->data))
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
			$regex = '/(?<=\tpublic\sfunction\s).{1,50}(?=\()|(?<=\tpublic\sfunction\s).{1,50}(?=\s\()|(?<=\s\s\s\spublic\sfunction\s).{1,50}(?=\()|(?<=\s\s\s\spublic\sfunction\s).{1,50}(?=\s\()|(?<=\spublic\sfunction\s).{1,50}(?=\()|(?<=\spublic\sfunction\s).{1,50}(?=\s\()/';		

			/*----- PEGA ACTIONS DE PLUGINS - CONTROLLER E CONTROLLERS ------- */
			//Pega caminho dos Plugins dentro do Projeto
			$path = APP.'Plugin/';
			$plugins = glob($path.'*') or die("Erro ao acessar " . $path);
			$completa = array();

			foreach ($plugins as $key => $value) {
				//Separa o caminho pela chave '/' e inverte a array para que o primeiro valor do array seja o nome do Plugin
				$inverte = explode('/', $value);
				$invertida = array_reverse($inverte);
				//Pega todos os Controllers do Plugin selecionado
				$controllers = App::objects($invertida[0].'.Controller');

				if ($invertida[0] != 'Contador') {
					foreach ($controllers as $chave => $valor) {
						/*A variável $controllers recebe um valor identico a "UsersController"
							Porém vamos precisar usar o App::import e para isso é preciso separar o "UsersController" em "User" "Controller"		
						*/
						//$pass1 = preg_replace("/([a-z])([A-Z])/","\\1 \\2",$controllers[$chave]);
						//$pass2 = preg_replace("/([A-Z])([A-Z][a-z])/","\\1 \\2",$pass1);
						$controller = explode('Controller', $controllers[$chave]);
						
						if (is_file($path.$invertida[0].'/Controller/'.$controller[0].'Controller.php') && strpos($controller[0], 'App') === false){
							//Ok, aqui importamos a Controller e todas as actions.
							$file = file_get_contents($path.$invertida[0].'/Controller/'.$controller[0].'Controller.php');
							preg_match_all($regex, $file, $actions);

							$actions = $actions[0];

							$actions = array_diff($actions, get_class_methods('AppController'));
							foreach ($actions as $action) {
								if (empty($completa[$invertida[0]][$controller[0]])) {
									$completa[$invertida[0]][$controller[0]] = array();
								}
								//$completa[] = array('Plugin' => $invertida[0], 'Controller' => $controller[0], 'Action' => $action);
								//if ($action == 'index' || $action == 'cadastrar' || $action == 'editar' || $action == 'visualizar' || $action == 'deletar'){
								if (!in_array($action, $completa[$invertida[0]][$controller[0]])) {
									$completa[$invertida[0]][$controller[0]][] = $action;
								}
							}
							
						}
					}
				}
			}


			$path1 = APP.'Controller/';
			$controll = glob($path1.'*') or die("Erro ao acessar " . $path1);

			foreach ($controll as $key1 => $value1) {
				$inverte1 = explode('/', $value1);
				$invertida1 = array_reverse($inverte1);
				$semPhp = explode('.', $invertida1[0]);
				
				//$pass1 = preg_replace("/([a-z])([A-Z])/","\\1 \\2",$semPhp[0]);
				//$pass2 = preg_replace("/([A-Z])([A-Z][a-z])/","\\1 \\2",$pass1);
				//$controller1 = explode(' ', $pass2);

				$controller1 = explode('Controller', $semPhp[0]);
		
				if (is_file($path1.$invertida1[0]) && $controller1[0] != 'App' ) {		   
					$file = file_get_contents($path1.$invertida1[0]);
					preg_match_all($regex, $file, $actions1);

					$actions1 = $actions1[0];

					$actions1 = array_diff($actions1, get_class_methods('AppController'));
					foreach ($actions1 as $action1) {
						if (empty($completa[''][$controller1[0]])) {
							$completa[''][$controller1[0]] = array();
						}
						//$completa[] = array('Plugin' => '', 'Controller' => $controller1[0], 'Action' => $action1);
						//if ($action1 == 'index' || $action1 == 'cadastrar' || $action1 == 'editar' || $action1 == 'visualizar' || $action1 == 'deletar'){
						if (!in_array($action1, $completa[''][$controller1[0]])) {
							$completa[''][$controller1[0]][] = $action1;
						}
					}
				}
			}
			/*----- FIM PEGA ACTIONS DE PLUGINS - CONTROLLER E CONTROLLERS ------- */

			$salvar = array();
			foreach ($completa as $plugin => $value) {
				foreach ($value as $controller => $value2) {
					foreach ($value2 as $value3 => $action) {
						$salvar[] = array(
							'plugin' => $plugin,
							'controller' => $controller,
							'action' => $action,
						);
					}
				}
			}

			$permissao = $completa;
			$this->set('permissao', $permissao);
			$this->User->Permission->virtualFields = array('permission' => 'CONCAT(plugin, "_", controller, "_", action)');
			$permissoes = $this->User->Permission->find('list', array('fields' => array('permission', 'allowed'), 'conditions' => array('Permission.user_id' => $id)));
			$this->set('permissoes', $permissoes);
			//requisições diferente de Put e Post retorna array com informações do registro $id
			$this->request->data = $this->User->read(null, $id);
			unset($this->request->data['User']['password']);
		}
	}

	public function delete($id = null)
	{
		$this->autoRender = false;
		//verificando metodo de requisição
		if (!$this->request->is('post'))
		{
			json_encode('Metodo Não Permitido');
		}
		//verificando se este $id existe
		$this->User->id = $id;
		if (!$this->User->exists())
		{
			json_encode('Usuário inexistente!');
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

	public function permissao_padrao() {
		$this->loadModel('PermissaoPadrao');
		if ($this->request->is('put') || $this->request->is('post')) {
			$this->PermissaoPadrao->deleteAll(array('church_id' => $this->Session->read('choosed')), false);
			$existe = array();
			$corretas = array();
			foreach ($this->request->data['PermissaoPadrao'] as $key => $permission) {
				if (!empty($permission['allowed']) && $permission['allowed'] == '1') {
					if (empty($existe[$permission['plugin'].'-'.$permission['controller'].'-'.$permission['action']])) {
						$existe[$permission['plugin'].'-'.$permission['controller'].'-'.$permission['action']] = '1';
						$cascades = $this->cascade($permission['plugin'], $permission['controller'], $permission['action']);
						foreach ($cascades as $key => $cascade) {
							if (empty($existe[$cascade['Cascade']['plugin_para'].'-'.$cascade['Cascade']['controller_para'].'-'.$cascade['Cascade']['action_para']])) {
								$existe[$cascade['Cascade']['plugin_para'].'-'.$cascade['Cascade']['controller_para'].'-'.$cascade['Cascade']['action_para']] = '1';
								$corretas[] = array(
									'plugin' => $cascade['Cascade']['plugin_para'],
									'controller' => $cascade['Cascade']['controller_para'],
									'action' => $cascade['Cascade']['action_para'],
									'allowed' => '1',
								);
							}
						}
					}
				} else {
					unset($this->request->data['PermissaoPadrao'][$key]);
				}
			}
			$this->request->data['PermissaoPadrao'] = array_merge($this->request->data['PermissaoPadrao'], $corretas);
			//Requisição Put ou Post tenta salvar alterações no registro
			$this->PermissaoPadrao->create();
			if ($this->PermissaoPadrao->saveAll($this->request->data['PermissaoPadrao'])) {
				$this->redirect(array('action' => 'permissao_padrao'));
			}
		} else {
			$regex = '/(?<=\tpublic\sfunction\s).{1,50}(?=\()|(?<=\tpublic\sfunction\s).{1,50}(?=\s\()|(?<=\s\s\s\spublic\sfunction\s).{1,50}(?=\()|(?<=\s\s\s\spublic\sfunction\s).{1,50}(?=\s\()|(?<=\spublic\sfunction\s).{1,50}(?=\()|(?<=\spublic\sfunction\s).{1,50}(?=\s\()/';		

			/*----- PEGA ACTIONS DE PLUGINS - CONTROLLER E CONTROLLERS ------- */
			//Pega caminho dos Plugins dentro do Projeto
			$path = APP.'Plugin/';
			$plugins = glob($path.'*') or die("Erro ao acessar " . $path);
			$completa = array();

			foreach ($plugins as $key => $value) {
				//Separa o caminho pela chave '/' e inverte a array para que o primeiro valor do array seja o nome do Plugin
				$inverte = explode('/', $value);
				$invertida = array_reverse($inverte);
				//Pega todos os Controllers do Plugin selecionado
				$controllers = App::objects($invertida[0].'.Controller');

				if ($invertida[0] != 'Contador') {
					foreach ($controllers as $chave => $valor) {
						/*A variável $controllers recebe um valor identico a "UsersController"
							Porém vamos precisar usar o App::import e para isso é preciso separar o "UsersController" em "User" "Controller"		
						*/
						//$pass1 = preg_replace("/([a-z])([A-Z])/","\\1 \\2",$controllers[$chave]);
						//$pass2 = preg_replace("/([A-Z])([A-Z][a-z])/","\\1 \\2",$pass1);
						$controller = explode('Controller', $controllers[$chave]);
						
						if (is_file($path.$invertida[0].'/Controller/'.$controller[0].'Controller.php') && strpos($controller[0], 'App') === false){
							//Ok, aqui importamos a Controller e todas as actions.
							$file = file_get_contents($path.$invertida[0].'/Controller/'.$controller[0].'Controller.php');
							preg_match_all($regex, $file, $actions);

							$actions = $actions[0];

							$actions = array_diff($actions, get_class_methods('AppController'));
							foreach ($actions as $action) {
								if (empty($completa[$invertida[0]][$controller[0]])) {
									$completa[$invertida[0]][$controller[0]] = array();
								}
								//$completa[] = array('Plugin' => $invertida[0], 'Controller' => $controller[0], 'Action' => $action);
								//if ($action == 'index' || $action == 'cadastrar' || $action == 'editar' || $action == 'visualizar' || $action == 'deletar'){
								if (!in_array($action, $completa[$invertida[0]][$controller[0]])) {
									$completa[$invertida[0]][$controller[0]][] = $action;
								}
							}
							
						}
					}
				}
			}


			$path1 = APP.'Controller/';
			$controll = glob($path1.'*') or die("Erro ao acessar " . $path1);

			foreach ($controll as $key1 => $value1) {
				$inverte1 = explode('/', $value1);
				$invertida1 = array_reverse($inverte1);
				$semPhp = explode('.', $invertida1[0]);
				
				//$pass1 = preg_replace("/([a-z])([A-Z])/","\\1 \\2",$semPhp[0]);
				//$pass2 = preg_replace("/([A-Z])([A-Z][a-z])/","\\1 \\2",$pass1);
				//$controller1 = explode(' ', $pass2);

				$controller1 = explode('Controller', $semPhp[0]);
		
				if (is_file($path1.$invertida1[0]) && $controller1[0] != 'App' ) {		   
					$file = file_get_contents($path1.$invertida1[0]);
					preg_match_all($regex, $file, $actions1);

					$actions1 = $actions1[0];

					$actions1 = array_diff($actions1, get_class_methods('AppController'));
					foreach ($actions1 as $action1) {
						if (empty($completa[''][$controller1[0]])) {
							$completa[''][$controller1[0]] = array();
						}
						//$completa[] = array('Plugin' => '', 'Controller' => $controller1[0], 'Action' => $action1);
						//if ($action1 == 'index' || $action1 == 'cadastrar' || $action1 == 'editar' || $action1 == 'visualizar' || $action1 == 'deletar'){
						if (!in_array($action1, $completa[''][$controller1[0]])) {
							$completa[''][$controller1[0]][] = $action1;
						}
					}
				}
			}
			$permissao = $completa;
			$this->set('permissao', $permissao);
			$this->PermissaoPadrao->virtualFields = array('permission' => 'CONCAT(plugin, "_", controller, "_", action)');
			$permissoes = $this->PermissaoPadrao->find('list', array('fields' => array('permission', 'allowed'), 'conditions' => array('PermissaoPadrao.church_id' => $this->Session->read('choosed'))));
			$this->set('permissoes', $permissoes);	
		}
	}
}