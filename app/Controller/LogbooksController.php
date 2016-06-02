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
		if((!empty($_SESSION['role'])) && ($_SESSION['role']=='Administrador')){
			//Limpia el cache.
        	clearCache();
			$logbooks = $this->Logbook->find('all', array('order' => array('Logbook.modified' => 'DESC')));
			$this->set('logbooks', $logbooks);
		} else {
			$this->Flash->error(__('No tiene el permiso suficiente para acceder a esta sección.'));
		}
	}

	public function add() {
		if ($this->request->is('post')) {
			$this->Logbook->create();
			if ($this->Logbook->save($this->request->data)) {
				$this->Flash->success(__('The logbook has been saved.'));
				return $this->redirect(array('action' => 'index'));
			} else {
				$this->Flash->error(__('The logbook could not be saved. Please, try again.'));
			}
		}
		$users = $this->Logbook->User->find('list');
		$categories = $this->Logbook->Categorie->find('list');
		$this->set(compact('users', 'categories'));
	}

}
