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
 
 //No debe tener index porque ya con el view se ve cada noticia individualmente y sino se ve desde el controlador de news
	// public function index() {
	// 	$this->NewsEventsPicture->recursive = 0;
	// 	$this->set('newsEventsPictures', $this->Paginator->paginate());
	// }

/**
 * view method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
 //Comentado porque no se van a ver imagenes de noticias individualmente sino que en galera(view_images...)
	// public function view($id = null) {
	// 	if (!$this->NewsEventsPicture->exists($id)) {
	// 		throw new NotFoundException(__('Invalid news events picture'));
	// 	}
	// 	$options = array('conditions' => array('NewsEventsPicture.' . $this->NewsEventsPicture->primaryKey => $id));
	// 	$this->set('newsEventsPicture', $this->NewsEventsPicture->find('first', $options));
	// }

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
					
				if($this->request->data['NewsEventsPicture']['news_id']!=null)
					return $this->redirect(array('action' => 'view_images_news',$this->request->data['NewsEventsPicture']['news_id']));
				else
					return $this->redirect(array('action' => 'view_images_events',$this->request->data['NewsEventsPicture']['event_id']));
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
 * viewImagesNews method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function view_images_news($id = null) {
		
		$options = array('conditions' => array('NewsEventsPicture.' . $this->NewsEventsPicture->primaryKey => $id));
		
		$allPicturesOfThisNews = $this->NewsEventsPicture->find('all', array('recursive'=>-1,'conditions' => array('NewsEventsPicture.news_id' => $id)));
		$this->set('pictures', $allPicturesOfThisNews);
		$this->set('id',$id);
	}
		/**
 * viewImagesEvents method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function view_images_events($id = null) {
		
		// return debug("adsfs");
		$options = array('conditions' => array('NewsEventsPicture.' . $this->NewsEventsPicture->primaryKey => $id));
		
		$allPicturesOfThisEvent = $this->NewsEventsPicture->find('all', array('recursive'=>-1,'conditions' => array('NewsEventsPicture.event_id' => $id)));
		$this->set('pictures', $allPicturesOfThisEvent);
		$this->set('id',$id);
	}

/**
 * edit method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	// public function edit($id = null) {
	// 	if (!$this->NewsEventsPicture->exists($id)) {
	// 		throw new NotFoundException(__('Invalid news events picture'));
	// 	}
	// 	if ($this->request->is(array('post', 'put'))) {
	// 		if ($this->NewsEventsPicture->save($this->request->data)) {
	// 			$this->Flash->success(__('The news events picture has been saved.'));
	// 			return $this->redirect(array('action' => 'index'));
	// 		} else {
	// 			$this->Flash->error(__('The news events picture could not be saved. Please, try again.'));
	// 		}
	// 	} else {
	// 		$options = array('conditions' => array('NewsEventsPicture.' . $this->NewsEventsPicture->primaryKey => $id));
	// 		$this->request->data = $this->NewsEventsPicture->find('first', $options);
	// 	}
	// 	$users = $this->NewsEventsPicture->User->find('list');
	// 	$news = $this->NewsEventsPicture->News->find('list');
	// 	$events = $this->NewsEventsPicture->Event->find('list');
	// 	$this->set(compact('users', 'news', 'events'));
	// }

/**
 * delete method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function delete($id = null) {
			//	return debug($id);

		$this->NewsEventsPicture->id = $id;
		if (!$this->NewsEventsPicture->exists()) {
			throw new NotFoundException(__('Invalid news events picture'));
		}
		
		
		$specificallyThisOne = $this->NewsEventsPicture->find('first', array('recursive'=>-1,'conditions' => array('NewsEventsPicture.id' => $id)));
		
		 //return debug($specificallyThisOne);
	
		$this->request->allowMethod('post', 'delete');
		 //debug($id);
		 //return debug($specificallyThisOne['NewsEventsPicture']['news_id']);
		if ($this->NewsEventsPicture->delete()) {
			$this->Flash->success(__('The news events picture has been deleted.'));
		} else {
			$this->Flash->error(__('The news events picture could not be deleted. Please, try again.'));
		}
		if($specificallyThisOne['NewsEventsPicture']['news_id']!=null)
				return $this->redirect(array('action' => 'view_images_news',$specificallyThisOne['NewsEventsPicture']['news_id']));
			else
				return $this->redirect(array('action' => 'view_images_events',$specificallyThisOne['NewsEventsPicture']['event_id']));
			
	}
}
