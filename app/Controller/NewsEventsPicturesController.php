<?php
App::uses('AppController', 'Controller');
/**
 * NewsEventsPictures Controller
 *
 * @property NewsEventsPicture $NewsEventsPicture
 * @property PaginatorComponent $Paginator
 * @property FlashComponent $Flash
 * @property SessionComponent $Session
 */
class NewsEventsPicturesController extends AppController {

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
		$this->NewsEventsPicture->recursive = 0;
		$this->set('newsEventsPictures', $this->Paginator->paginate());
	}

/**
 * view method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function view($id = null) {
		if (!$this->NewsEventsPicture->exists($id)) {
			throw new NotFoundException(__('Invalid news events picture'));
		}
		$options = array('conditions' => array('NewsEventsPicture.' . $this->NewsEventsPicture->primaryKey => $id));
		$this->set('newsEventsPicture', $this->NewsEventsPicture->find('first', $options));
	}

/**
 * add method
 *
 * @return void
 */
	public function add() {
		if ($this->request->is('post')) {
			$this->NewsEventsPicture->create();
			if ($this->NewsEventsPicture->save($this->request->data)) {
				$this->Flash->success(__('The news events picture has been saved.'));
				return $this->redirect(array('action' => 'index'));
			} else {
				$this->Flash->error(__('The news events picture could not be saved. Please, try again.'));
			}
		}
		$users = $this->NewsEventsPicture->User->find('list');
		$news = $this->NewsEventsPicture->News->find('list');
		$events = $this->NewsEventsPicture->Event->find('list');
		$this->set(compact('users', 'news', 'events'));
	}

/**
 * edit method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function edit($id = null) {
		if (!$this->NewsEventsPicture->exists($id)) {
			throw new NotFoundException(__('Invalid news events picture'));
		}
		if ($this->request->is(array('post', 'put'))) {
			if ($this->NewsEventsPicture->save($this->request->data)) {
				$this->Flash->success(__('The news events picture has been saved.'));
				return $this->redirect(array('action' => 'index'));
			} else {
				$this->Flash->error(__('The news events picture could not be saved. Please, try again.'));
			}
		} else {
			$options = array('conditions' => array('NewsEventsPicture.' . $this->NewsEventsPicture->primaryKey => $id));
			$this->request->data = $this->NewsEventsPicture->find('first', $options);
		}
		$users = $this->NewsEventsPicture->User->find('list');
		$news = $this->NewsEventsPicture->News->find('list');
		$events = $this->NewsEventsPicture->Event->find('list');
		$this->set(compact('users', 'news', 'events'));
	}

/**
 * delete method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function delete($id = null) {
		$this->NewsEventsPicture->id = $id;
		if (!$this->NewsEventsPicture->exists()) {
			throw new NotFoundException(__('Invalid news events picture'));
		}
		$this->request->allowMethod('post', 'delete');
		if ($this->NewsEventsPicture->delete()) {
			$this->Flash->success(__('The news events picture has been deleted.'));
		} else {
			$this->Flash->error(__('The news events picture could not be deleted. Please, try again.'));
		}
		return $this->redirect(array('action' => 'index'));
	}
}
