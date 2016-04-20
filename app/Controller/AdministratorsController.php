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
		if (!$this->Administrator->exists($id)) {
			throw new NotFoundException(__('Invalid administrator'));
		}
		$options = array('conditions' => array('Administrator.' . $this->Administrator->primaryKey => $id));
		$this->set('administrator', $this->Administrator->find('first', $options));
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
		if (!$this->Administrator->exists()) {
			throw new NotFoundException(__('Invalid administrator'));
		}
		$this->request->allowMethod('post', 'delete');
		if ($this->Administrator->delete()) {
			$this->Flash->success(__('The administrator has been deleted.'));
		} else {
			$this->Flash->error(__('The administrator could not be deleted. Please, try again.'));
		}
		return $this->redirect(array('action' => 'index'));
	}
}
