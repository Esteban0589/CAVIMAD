<?php
App::uses('AppController', 'Controller');
/**
 * Categories Controller
 *
 * @property Category $Category
 * @property PaginatorComponent $Paginator
 * @property FlashComponent $Flash
 * @property SessionComponent $Session
 */
class CategoriesController extends AppController {

	var $clasificacion = array('Filo' => 'Filo','Subfilo' => 'Subfilo','Clase' => 'Clase','Orden' => 'Orden','Familia' => 'Familia','Genero' => 'Genero','Especie' => 'Especie');
	var $name = 'Categories';
/**
 * Components
 *
 * @var array
 */
	public $components = array('Paginator', 'Flash', 'Session');
	
	 public function beforeFilter() {
        parent::beforeFilter();
        $this->Auth->allow('index','edit','delete');
    }

/**
 * index method
 *
 * @return void
 */
	public function index() {
			$d = $this->Category->generateTreeList(null,null,null,'--');
			$this->set('categories', $d);
		// $this->Category->recursive = 0;
		// $this->set('categories', $this->Paginator->paginate());
	}
/**
 * edit method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function edit($id = null) {
		$this->set('clasificacion', $this->clasificacion);
		if ($this->request->is(array('post', 'put'))) {
			if ($this->Category->save($this->request->data)) {
				debug($this->request->data);
				$this->Flash->success(__('El nivel topologico fue agregado.'));
				return $this->redirect(array('action' => 'index'));
			}else {
				$this->Flash->error(__('El nivel topologico no pudo ser agregado, intente nuevamente.'));
			}
		} else {
			$options = array('conditions' => array('Category.' . $this->Category->primaryKey => $id));
			$this->request->data = $this->Category->find('first', $options);
			$d = $this->Category->generateTreeList(null,null,null,'--');
			$this->set('categories', $d);
		}
	
	
		
		
		
		
		// if (!$this->Category->exists($id)) {
		// 	throw new NotFoundException(__('Invalid category'));
		// }
		// if ($this->request->is(array('post', 'put'))) {
		// 	if ($this->Category->save($this->request->data)) {
		// 		$this->Flash->success(__('The category has been saved.'));
		// 		return $this->redirect(array('action' => 'index'));
		// 	} else {
		// 		$this->Flash->error(__('The category could not be saved. Please, try again.'));
		// 	}
		// } else {
		// 	$options = array('conditions' => array('Category.' . $this->Category->primaryKey => $id));
		// 	$this->request->data = $this->Category->find('first', $options);
		// }
		// $parentCategories = $this->Category->ParentCategory->find('list');
		// $this->set(compact('parentCategories'));
	}
	
	

/**
 * view method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function view($id = null) {
		if (!$this->Category->exists($id)) {
			throw new NotFoundException(__('Invalid category'));
		}
		$options = array('conditions' => array('Category.' . $this->Category->primaryKey => $id));
		$this->set('category', $this->Category->find('first', $options));
	}

/**
 * add method
 *
 * @return void
 */
	public function add() {
		if ($this->request->is('post')) {
			$this->Category->create();
			if ($this->Category->save($this->request->data)) {
				$this->Flash->success(__('The category has been saved.'));
				return $this->redirect(array('action' => 'index'));
			} else {
				$this->Flash->error(__('The category could not be saved. Please, try again.'));
			}
		}
		$parentCategories = $this->Category->ParentCategory->find('list');
		$this->set(compact('parentCategories'));
	}


/**
 * delete method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function delete($id = null) {
		$this->Category->id = $id;
		if (!$this->Category->exists()) {
			throw new NotFoundException(__('Invalid category'));
		}
		$this->request->allowMethod('post', 'delete');
		$this->Category->removeFromTree($id);
			debug($id);
			$this->Flash->success(__('The category has been deleted.'));
		// } else {
		// 	$this->Flash->error(__('The category could not be deleted. Please, try again.'));
		// }
		return $this->redirect(array('action' => 'index'));
	}
}
