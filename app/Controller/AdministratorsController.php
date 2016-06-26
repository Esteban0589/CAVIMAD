<?php
App::uses('AppController', 'Controller');
/**
 * Administrators Controller
 *
 * @property Administrator $Administrator
 * @property PaginatorComponent $Paginator
 */
class AdministratorsController extends AppController {

/**
 * Components
 *
 * @var array
 */
	public $components = array('Paginator');

/**
 * index method
 *
 * @return void
 */
	public function index() {
		if ( $this->Session->read('Auth')['User']['role'] != 'Administrador'  ) {
			throw new NotFoundException(__('Usuario no valido.'));
			return $this->redirect(array('controller' => 'pages','action' => 'display'));
		}
		$this->Administrator->recursive = 0;
		$this->set('administrators', $this->Paginator->paginate());
	}

/**
 * view method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function view($id = null) {
		if ( $this->Session->read('Auth')['User']['role'] != 'Administrador'  ) {
			throw new NotFoundException(__('Usuario no valido.'));
			return $this->redirect(array('controller' => 'pages','action' => 'display'));
		}
		if (!$this->Administrator->exists($id)) {
			throw new NotFoundException(__('Invalid administrator'));
		}
		$options = array('conditions' => array('Administrator.' . $this->Administrator->primaryKey => $id));
		$this->set('administrator', $this->Administrator->find('first', $options));
	}

	public function beforeFilter() {
        parent::beforeFilter();
        $this->Auth->allow('add','logout', 'login', 'index', 'edit', 'view', 'delete');
    }


/**
 * add method
 *
 * @return void
 */
	public function add() {
		if ($this->request->is('post')) {
			$this->Administrator->create();
			if ($this->Administrator->save($this->request->data)) {
				$this->Flash->success(__('The administrator has been saved.'));
				return $this->redirect(array('action' => 'index'));
			} else {
				$this->Flash->error(__('The administrator could not be saved. Please, try again.'));
			}
		}
		$users = $this->Administrator->User->find('list');
		$this->set(compact('users'));
	}

/**
 * edit method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function edit($id = null) {
		if ( $this->Session->read('Auth')['User']['role'] != 'Administrador'  ) {
			throw new NotFoundException(__('Usuario no valido.'));
			return $this->redirect(array('controller' => 'pages','action' => 'display'));
		}
		if (!$this->Administrator->exists($id)) {
			throw new NotFoundException(__('Invalid administrator'));
		}
		if ($this->request->is(array('post', 'put'))) {
			if ($this->Administrator->save($this->request->data)) {
				$this->Flash->success(__('The administrator has been saved.'));
				return $this->redirect(array('action' => 'index'));
			} else {
				$this->Flash->error(__('The administrator could not be saved. Please, try again.'));
			}
		} else {
			$options = array('conditions' => array('Administrator.' . $this->Administrator->primaryKey => $id));
			$this->request->data = $this->Administrator->find('first', $options);
		}
		$users = $this->Administrator->User->find('list');
		$this->set(compact('users'));
	}

/**
 * delete method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function delete($id = null) {
		$this->Administrator->id = $id;
		//Si el administrador a buscar no existe se notifica mediante un mensaje de error
		if (!$this->Administrator->exists()) {
			throw new NotFoundException(__('Invalid administrator'));
		}
		$this->request->allowMethod('post', 'delete');
		//Si el adminstrador se pudo borrar se notifica mediante un mensaje
			$this->Flash->success(__('The administrator has been deleted.'));
		} else {
			//Si administrador no se pudo eliminra se notifica mediante un mensaje de error
			$this->Flash->error(__('The administrator could not be deleted. Please, try again.'));
		}
		// si la accion es completada redirecciona al index de administradores
		return $this->redirect(array('action' => 'index'));
	}
}
