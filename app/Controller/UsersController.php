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

	    public function teste(){
	    	$this->layout = '';
	    }

}