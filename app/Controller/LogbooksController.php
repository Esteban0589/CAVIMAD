<?php
App::uses('AppController', 'Controller');
/**
 * Logbooks Controller
 *
 * @property Logbook $Logbook
 * @property PaginatorComponent $Paginator
 * @property FlashComponent $Flash
 * @property SessionComponent $Session
 */
class LogbooksController extends AppController {


/**
 * Helpers
 *
 * @var array
 */
	public $helpers = array('Js');

/**
 * Components
 *
 * @var array
 */
	public $components = array('Paginator', 'Flash', 'Session');

/**
 * index method
 *
 * @return void
 */
	public function index() {
		if((!empty($this->Session->read('Auth')['User']['role'])) && ($this->Session->read('Auth')['User']['role']=='Administrador')){
			//Limpia el cache.
        	clearCache();
			$logbooks = $this->Logbook->find('all', array('order' => array('Logbook.modified' => 'desc')));
			$this->set('logbooks', $logbooks);
			// notifica al usuario de no poder ser guardado
		} else {
			$this->Flash->error(__('No tiene el permiso suficiente para acceder a esta sección.'));
		}
	}



/**
 * add method
 *
 * @return void
 */
	public function add() {
		if ($this->request->is('post')) {
			$this->Logbook->create();
			// crea un nuevo logbook y lo guarda
			if ($this->Logbook->save($this->request->data)) {
				$this->Flash->success(__('The logbook has been saved.'));
				return $this->redirect(array('action' => 'index'));
			} else {
				// notifica al usuario de no poder ser guardado
				$this->Flash->error(__('The logbook could not be saved. Please, try again.'));
			}
		}
		$users = $this->Logbook->User->find('list');
		$categories = $this->Logbook->Categorie->find('list');
		$this->set(compact('users', 'categories'));
	}

}
