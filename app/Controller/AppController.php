<?php
/**
 * Application level Controller
 *
 * This file is application-wide controller file. You can put all
 * application-wide controller-related methods here.
 *
 * CakePHP(tm) : Rapid Development Framework (http://cakephp.org)
 * Copyright (c) Cake Software Foundation, Inc. (http://cakefoundation.org)
 *
 * Licensed under The MIT License
 * For full copyright and license information, please see the LICENSE.txt
 * Redistributions of files must retain the above copyright notice.
 *
 * @copyright     Copyright (c) Cake Software Foundation, Inc. (http://cakefoundation.org)
 * @link          http://cakephp.org CakePHP(tm) Project
 * @package       app.Controller
 * @since         CakePHP(tm) v 0.2.9
 * @license       http://www.opensource.org/licenses/mit-license.php MIT License
 */

App::uses('Controller', 'Controller');

/**
 * Application Controller
 *
 * Add your application-wide methods in the class below, your controllers
 * will inherit them.
 *
 * @package		app.Controller
 * @link		http://book.cakephp.org/2.0/en/controllers.html#the-app-controller
 */
App::import('Vendor', 'Facebook', array('file' => 'facebook-php/src/facebook.php'));
class AppController extends Controller {
	public $components = array('Auth', 'Session');

	public $fb_url;

    public function beforeFilter() {
	    $this->Facebook = new Facebook(array(
	        'appId'     =>  '266658286843599',
	        'secret'    =>  '970cebae1c0f9a6b7bfd15cc6912d12d'
	    ));
    	$this->Auth->allow(array('login', 'logout', 'teste', 'index'));
    	$this->Session->write('choosed', '1');
	}

	public function beforeRender() {
		$this->fb_url = $this->Facebook->getLoginUrl(array('scope' => 'read_stream, friends_likes, email', 'display' => 'page','redirect_uri' => Router::url(array('controller' => 'users', 'action' => 'login'), true)));
	    $this->set('fb_login_url', $this->fb_url);
	    $this->set('user', $this->Auth->user());
	}
}