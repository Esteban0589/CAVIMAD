<?php
App::uses('AppController', 'Controller');
/**
 * Controlador encargado de agregar, editar, mostrar y eliminar comentarios
 * 
 * @param void
 * @return void
 */
class CommentsController extends AppController {

/**
 * Componentes necesarios para los comentarios
 *
 * @var array
 */
	public $components = array('Paginator', 'Flash', 'Session');

/**
 * index 
 *
 * Permite ver todos los comentarios
 * 
 * @param void
 * @return void
 */
	public function index() {
		$this->Comment->recursive = 0;
		$this->set('comments', $this->Paginator->paginate());
	}

/**
 * view method
 * 
 * Metodo que permite ver un comentario en específico
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
 * Metodo para agregar comentarios
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
 * Metodo para editar un comentario especicado por $id.
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
 * Metodo para borrar un comentario en especifico.
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
