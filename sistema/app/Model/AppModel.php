<?php
/**
 * Application model for CakePHP.
 *
 * This file is application-wide model file. You can put all
 * application-wide model-related methods here.
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
 * @package       app.Model
 * @since         CakePHP(tm) v 0.2.9
 * @license       http://www.opensource.org/licenses/mit-license.php MIT License
 */

App::uses('Model', 'Model');

/**
 * Application model for Cake.
 *
 * Add your application-wide methods in the class below, your models
 * will inherit them.
 *
 * @package       app.Model
 */
class AppModel extends Model {
	public function beforeFind($queryData){
		//Carrega Componentes de Sessão Cake
		App::uses('CakeSession', 'Model/Datasource');
		$choosed = CakeSession::read('choosed');
		//Verifica se o campo church_id existe na model e se $choosed não é vazio
		if(($this->hasField('church_id') && !empty($choosed)) && ($this->name != 'User' && !empty($queryData['conditions']['User.id'])))
		{
			//seta o church_id para pesquisa na model
			$queryData['conditions'][$this->name.'.church_id']  = $choosed;
		}
		//retorna dados da pesquisa
		return $queryData;
	}

	public function beforeSave($options = array()){
		//Carrega Componentes de Sessão Cake
	    App::uses('CakeSession', 'Model/Datasource');
		$choosed = CakeSession::read('choosed');
		$user_id = CakeSession::read('Auth.User.id');
		//seta o campo curch_id com o valor de $choosed para ser salvo
		if ($this->name != 'Permission') {
			$this->data[$this->name]['user_id'] = $user_id;	
		}
		if ($this->name != 'Church' && $this->name != 'User') {
	    	$this->data[$this->name]['church_id'] = $choosed;
	    }
	    return true;
	}
}
