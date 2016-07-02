<?php
App::uses('AppController', 'Controller');
/**
 * HomePictures Controller
 *
 * @property HomePicture $HomePicture
 * @property PaginatorComponent $Paginator
 * @property FlashComponent $Flash
 * @property SessionComponent $Session
 */
class HomePicturesController extends AppController {
	
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
		$this->HomePicture->recursive = 0;
		$this->set('homePictures', $this->Paginator->paginate());
	}

/**
 * view method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function view($id = null) {
		// si la imagen no existe retorna error de imagen invalida
		if (!$this->HomePicture->exists($id)) {
			throw new NotFoundException(__('Invalid home picture'));
		}
		$options = array('conditions' => array('HomePicture.' . $this->HomePicture->primaryKey => $id));
		$this->set('homePicture', $this->HomePicture->find('first', $options));
	}

/**
 * add method
 *
 * @return void
 */
	public function add() {
		if ($this->request->is('post')) {
			$this->HomePicture->create();
			// se guarda la imagen creada y notifica al usurio
			if ($this->HomePicture->save($this->request->data)) {
				$this->Flash->success(__('La imagen ha sido salvada.'));
				return $this->redirect(array('action' => 'index'));
				// si no puede guardarla retorna error
			} else {
				$this->Flash->error(__('La imagen no pudo ser salvada. Intentelo otra vez.'));
			}
		}
		//  agrega la ubicaion del comentario o lo omite
		else{
			$position = array(0 => 'Omitir comentario de imagen',1 => 'Abajo a la derecha',2 => 'Abajo a la izquierda');

			$this->set('position',$position);
		}
	}

/**
 * edit method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function edit($id = null) {
		// si la imagen no existe retorna error de imagen invalida
		if (!$this->HomePicture->exists($id)) {
			throw new NotFoundException(__('Invalid home picture'));
		}
		// se guarda la imagen editada y notifica al usurio
		if ($this->request->is(array('post', 'put'))) {
			if ($this->HomePicture->save($this->request->data)) {
				$this->Flash->success(__('La imagen ha sido salvada.'));
				 $this->redirect(array('action' => 'index'));
		debug($this->request->data);
		// si no puede guardarla retorna error
			} else {
				$this->Flash->error(__('La imagen no pudo ser salvada. Intentelo de nuevamente.'));
			}
		} else {
			$options = array('conditions' => array('HomePicture.' . $this->HomePicture->primaryKey => $id));
			$position = array(0 => 'Omitir comentario de imagen',1 => 'Abajo a la derecha',2 => 'Abajo a la izquierda');
			$this->request->data = $this->HomePicture->find('first', $options);
			$this->set('position',$position);
		}
	}

/**
 * delete method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function delete($id = null) {
		// si la imagen no existe retorna error de imagen invalida
		$this->HomePicture->id = $id;
		if (!$this->HomePicture->exists()) {
			throw new NotFoundException(__('Invalid home picture'));
		}
		$this->request->allowMethod('post', 'delete');
		// elimina la imagen y notifica al usurio
		if ($this->HomePicture->delete()) {
			$this->Flash->success(__('La imagen ha sido Eliminada.'));
			// si no puede elimisnarla retorna error
		} else {
			$this->Flash->error(__('La imagen no fue eliminada. Intentelo nuevamente'));
		}// retorna al index
		return $this->redirect(array('action' => 'index'));
	}
}
