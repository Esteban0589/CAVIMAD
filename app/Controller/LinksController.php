<?php
App::uses('AppController', 'Controller');
/**
 * Links Controller
 *
 * @property Link $Link
 * @property PaginatorComponent $Paginator
 * @property FlashComponent $Flash
 * @property SessionComponent $Session
 */
class LinksController extends AppController {

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
		$this->Link->recursive = 0;
		$this->set('links', $this->Paginator->paginate());
	}

    public function beforeFilter() {
        parent::beforeFilter();
        //Métodos a los cuales se permite llamar
        $this->Auth->allow('index','logout', 'login');
    }

/**
 * add method
 *
 * @return void
 */
	public function add() {
		$this->loadModel('User');
		$this->loadModel('Administrator');
		$adm_id=$this->Administrator->find('first',array('conditions' => array('Administrator.user_id'=>$_SESSION['Auth']['User']['id'])));
		//return debug($adm_id);
		if ($this->request->is('post')) {
			$data=array('Link' =>array('title'=>$this->request->data['Link']['title'], 
										'url'=>$this->request->data['Link']['url'],
										'description'=>$this->request->data['Link']['description'],
										'relatedpage'=>$this->request->data['Link']['relatedpage'],
										'administrator_id'=>$adm_id['Administrator']['id']));
			$this->Link->create();
			if ($this->Link->save($data)) {
				$this->Flash->success(__('El enlace se guardo correctamente.'));
				return $this->redirect(array('action' => 'index'));
			} else {
				$this->Flash->error(__('El enlace no se pudo guardar. Intentelo nuevamente.'));
			}
		}
	//	debug($user);
	}

		public function add_bio() {
		$this->loadModel('User');
		$this->loadModel('Administrator');
		$adm_id=$this->Administrator->find('first',array('conditions' => array('Administrator.user_id'=>$_SESSION['Auth']['User']['id'])));
		//return debug($adm_id);
		$bio='Biomonitoreo';
		if ($this->request->is('post')) {
			$data=array('Link' =>array('title'=>$this->request->data['Link']['title'], 
										'url'=>$this->request->data['Link']['url'],
										'description'=>$this->request->data['Link']['description'],
										'relatedpage'=>$bio,
										'administrator_id'=>$adm_id['Administrator']['id']));
			$this->Link->create();
			if ($this->Link->save($data)) {
				$this->Flash->success(__('El enlace se guardo correctamente.'));
				return $this->redirect(array('controller'=>'downloads','action' => 'index_bio'));
			} else {
				$this->Flash->error(__('El enlace no se pudo guardar. Intentelo nuevamente.'));
			}
		}
	//	debug($user);
	}

/**
 * edit method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function edit($id = null) {
		if (!$this->Link->exists($id)) {
			throw new NotFoundException(__('Invalid link'));
		}
		if ($this->request->is(array('post', 'put'))) {
			if ($this->Link->save($this->request->data)) {
				$this->Flash->success(__('El enlace se guardo correctamente.'));
				return $this->redirect(array('action' => 'index'));
			} else {
				$this->Flash->error(__('El enlace no se pudo guardar. Intentelo nuevamente.'));
			}
		} else {
			$options = array('conditions' => array('Link.' . $this->Link->primaryKey => $id));
			$this->request->data = $this->Link->find('first', $options);
		}
	}
	
	public function edit_bio($id = null) {
		if (!$this->Link->exists($id)) {
			throw new NotFoundException(__('Invalid link'));
		}
		if ($this->request->is(array('post', 'put'))) {
			if ($this->Link->save($this->request->data)) {
				$this->Flash->success(__('El enlace se guardo correctamente.'));
				return $this->redirect(array('controller'=>'downloads','action' => 'index_bio'));
			} else {
				$this->Flash->error(__('El enlace no se pudo guardar. Intentelo nuevamente.'));
			}
		} else {
			$options = array('conditions' => array('Link.' . $this->Link->primaryKey => $id));
			$this->request->data = $this->Link->find('first', $options);
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
		$this->Link->id = $id;
		if (!$this->Link->exists()) {
			throw new NotFoundException(__('Invalid link'));
		}
		$this->request->allowMethod('post', 'delete');
		if ($this->Link->delete()) {
			$this->Flash->success(__('El enlace se elimino correctamente.'));
		} else {
			$this->Flash->error(__('El enlace no se pudo eliminar. Intentelo nuevamente'));
		}
		return $this->redirect(array('action' => 'index'));
	}

	
}
