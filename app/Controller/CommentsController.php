<?php
App::uses('AppController', 'Controller');
/**
 * Comments Controller
 *
 * @property Comment $Comment
 * @property PaginatorComponent $Paginator
 * @property FlashComponent $Flash
 * @property SessionComponent $Session
 */
class CommentsController extends AppController {

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
		$this->Comment->recursive = 0;
		$this->set('comments', $this->Paginator->paginate());
	}

/**
 * view method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function view($id = null) {
		// si el comentario no existe notifica al usuario
		if (!$this->Comment->exists($id)) {
			throw new NotFoundException(__('Invalid comment'));
		}
		$options = array('conditions' => array('Comment.' . $this->Comment->primaryKey => $id));
		$this->set('comment', $this->Comment->find('first', $options));
	}

/**
 * add method
 *
 * @return void
 */
	public function add() {
		if ($this->request->is('post')) {
			$this->Comment->create();
			// si los datos son guardados correctamente notifica al usuario y lo redirige al index
			if ($this->Comment->save($this->request->data)) {
				$this->Flash->success(__('The comment has been saved.'));
				return $this->redirect(array('action' => 'index'));
				// si los datos no pueden ser guardados notifica al usuario
			} else {
				$this->Flash->error(__('The comment could not be saved. Please, try again.'));
			}
		}
		$users = $this->Comment->User->find('list');
		$categories = $this->Comment->Category->find('list');
		$this->set(compact('users', 'categories'));
	}

/**
 * edit method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function edit($id = null) {
		// si el comentario no existe notifica al usuario
		if (!$this->Comment->exists($id)) {
			throw new NotFoundException(__('Invalid comment'));
		}
		// si los datos son guardados correctamente notifica al usuario y lo redirige al index
		if ($this->request->is(array('post', 'put'))) {
			if ($this->Comment->save($this->request->data)) {
				$this->Flash->success(__('The comment has been saved.'));
				return $this->redirect(array('action' => 'index'));
			} else {
				// si los datos no pueden ser guardados notifica al usuario
				$this->Flash->error(__('The comment could not be saved. Please, try again.'));
			}
		} else {
			$options = array('conditions' => array('Comment.' . $this->Comment->primaryKey => $id));
			$this->request->data = $this->Comment->find('first', $options);
		}
		$users = $this->Comment->User->find('list');
		$categories = $this->Comment->Category->find('list');
		$this->set(compact('users', 'categories'));
	}

/**
 * delete method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function delete($id = null) {
		$this->Comment->id = $id;
		// si el comentario no existe notifica al usuario
		if (!$this->Comment->exists()) {
			throw new NotFoundException(__('Invalid comment'));
		}
		$this->request->allowMethod('post', 'delete');
		//si los datos pudieron se eleiminados notifica al usuaio 
		if ($this->Comment->delete()) {
			$this->Flash->success(__('The comment has been deleted.'));
		} else {
			$this->Flash->error(__('The comment could not be deleted. Please, try again.'));
		}
		return $this->redirect(array('action' => 'index'));
	}
}