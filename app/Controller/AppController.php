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
//Para habilitar el envío de correos electrónicos.
App::uses('CakeEmail', 'Network/Email');

/**
 * Application Controller
 *
 * Este controllador contiene los metodos y componentes que se utilizaran en todos los controllers hijos
 *
 */
class AppController extends Controller {
/**
 * Components
 *
 * Son los complementos que utilizaran los controllers que heredan de appController
 * 
 * @param void
 * @return void
 */
    public $components = array(
		'DebugKit.Toolbar',
		'Session',
        'Flash',
        'flash',
        'Cookie',
        'Auth' => array(
            'loginRedirect' => array(
                'controller' => 'pages',
				'action' => 'display',
				'home',
            ),
			'logoutRedirect' => array(
				'controller' => 'pages',
				'action' => 'display',
				'home',
			),
			'authenticate' => array(
				'Form' => array(
					'passwordHasher' => 'Blowfish'
				)
			),
			'flash' => array('element' => 'auth_error')
		)
	); 

/**
	 * beforeFilter method
	 * 
	 * Contiene los métodos a los cuales se permite llamar sin tener una sesión de usuario activa o sin los privilegios requeridos.
	 * 
	 * @param void
	 * @return void
	 */	
    public function beforeFilter(){
    	$this->Auth->allow('login');
    	$this->set('current_user', $this->Auth->user());
    	//Configuración para utilizar las cookies
		$this->Cookie->key = 'qSI232qs*&sXOw!adre@34SAv!@*(XSL#$%)asGb$@11~_+!@#HKis~#^';
		$this->Cookie->httpOnly = true;
		if (!$this->Auth->loggedIn() && $this->Cookie->read('remember_me_cookie')) {
			$cookie = $this->Cookie->read('remember_me_cookie');
			$this->loadModel("User");
			$user = $this->User->find('first', array(
			'conditions' => array(
			'User.username' => $cookie['username'],
			'User.password' => $cookie['password']
		)
		));
		if ($user && !$this->Auth->login($user['User'])) {
			$this->redirect('/users/logout'); //Destruye la sesión y la cookie
		}
		}
    }
    
}
