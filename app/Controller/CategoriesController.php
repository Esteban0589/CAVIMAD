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
		$this->Category->recursive = 0;
		$this->set('categories', $this->Paginator->paginate());
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
 * edit method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function edit($id = null) {
		if (!$this->Category->exists($id)) {
			throw new NotFoundException(__('Invalid category'));
		}
		if ($this->request->is(array('post', 'put'))) {
			if ($this->Category->save($this->request->data)) {
				$this->Flash->success(__('The category has been saved.'));
				return $this->redirect(array('action' => 'index'));
			} else {
				$this->Flash->error(__('The category could not be saved. Please, try again.'));
			}
		} else {
			$options = array('conditions' => array('Category.' . $this->Category->primaryKey => $id));
			$this->request->data = $this->Category->find('first', $options);
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
		if ($this->Category->delete()) {
			$this->Flash->success(__('The category has been deleted.'));
		} else {
			$this->Flash->error(__('The category could not be deleted. Please, try again.'));
		}
		return $this->redirect(array('action' => 'index'));
	}
	public function buscador(){
	$term = null;
	if(!empty($this->request->query['term'])){
		$term=$this->request->query['term'];
		$terms=explode(' ', trim($term));					
		$terms=array_diff($terms,array(''));
		foreach($terms as $term){
				$conditions[] = array(
				"OR" => array(
					    array('Users.username LIKE '=>'%'.$term.'%'),
					    array('Users.id LIKE '=>'%'.$term.'%')));
			}
		$this->loadModel(Users);
		$usuarios = $this->User->find('all', array('recursive'=>0, 'conditions'=>$conditions));
		echo json_enconde($usuarios);
		$this->autoRender=false;
	}
	
	
	/*	$buscar = $_POST['b'];
      if(!empty($buscar)) {
            buscar($buscar);
      }
      function buscar($b) {
       /* $id=($this->request->data['Product']['s']);
		//debug($id);
		if(($id)){
			$condition=explode(' ', trim($id));					
			$condition=array_diff($condition,array(''));		
			$conditions=null;	
			//$this->loadModel(Category);
			foreach($condition as $tconditions){
				$conditions[] = array(
				"OR" => array(
					    array('Users.username LIKE '=>'%'.$tconditions.'%'),
					    array('Users.id LIKE '=>'%'.$tconditions.'%')));

			}
			$this->loadModel('User');
			$var=$this->User->find('all', array('recursive'=>0, 'conditions'=>$conditions));
			//debug($productss);
			if(count($productss)>0){
				$this->set('products',$productss);
			}
			else{
				 $this->Flash->set(__('There are no products for this search.'));
				 //debug($id);
				 return $this->redirect(array('action' => 'index'));	
			}
		}
      }*/
	}
}
